<?php namespace Anomaly\SystemModule\Http\Controller\Admin;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\Console\Kernel;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\SystemModule\Telescope\Table\TelescopeTableBuilder;
use Laravel\Telescope\Contracts\EntriesRepository;
use Laravel\Telescope\Storage\EntryModel;

/**
 * Class TelescopeController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TelescopeController extends AdminController
{

    /**
     * Return an index of Telescope entries.
     *
     * @param TelescopeTableBuilder $table
     * @param $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($type = null)
    {
        if (!$type) {
            return redirect('admin/system/requests');
        }

        if (!$table = config("anomaly.module.system::telescope.watchers.{$type}.table")) {
            throw new \Exception("Config [anomaly.module.system::telescope.watchers.{$type}.table] not found.");
        }

        /* @var TelescopeTableBuilder $table */
        $table = app($table);

        return $table
            ->setType($type)
            ->render();
    }

    /**
     * View a Telescope entry.
     *
     * @param EntriesRepository $repository
     * @param Asset $asset
     * @param string $type
     * @param $id
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function view(EntriesRepository $repository, Asset $asset, $type, $id)
    {
        $watcher = config('anomaly.module.system::telescope.watchers.' . $type);

        if (!$view = array_get($watcher, 'view')) {
            dd($id);
        }

        try {
            $entry = (array)$repository->find($id);
        } catch (\Exception $exception) {
            return redirect('admin/system/' . $type);
        }

        $entry['tags'] = array_pop($entry);

        $this->breadcrumbs->add($id);

        $asset->add('styles.css', 'anomaly.module.system::css/prism.css');
        $asset->add('styles.css', 'anomaly.module.system::css/system.css');

        $asset->add('scripts.js', 'anomaly.module.system::js/prism.js');
        $asset->add('scripts.js', 'anomaly.module.system::js/initialize.js');

        /* @var Collection $collection */
        $collection = EntryModel::where('batch_id', $entry['batchId'])
            ->where('uuid', '!=', $id)
            ->where('type', '!=', 'dump')
            ->limit(-1)
            ->get()
            ->groupBy('type');

        $batch = (new Collection());

        foreach (['request'] as $type) {
            if ($collection->has($type)) {
                $batch->put($type, $collection->pull($type));
            }
        }

        foreach ($collection as $key => $items) {
            $batch->put($key, $items);
        }

        foreach ($batch as $type => $collection) {

            $watcher = !in_array($type, ['cache', 'mail', 'schedule']) ? str_plural($type) : $type;

            /* @var TelescopeTableBuilder $table */
            $table = app(config('anomaly.module.system::telescope.watchers.' . $watcher . '.table'));

            $table
                ->setFilters([])
                ->setActions([])
                ->setType($type)
                ->setOption('header_class', 'hidden')
                ->setOption('container_class', 'container-wide')
                ->setButtons(
                    [
                        'view' => [
                            'target' => '_blank',
                            'href'   => 'admin/system/' . str_plural($type) . '/view/{entry.uuid}',
                        ],
                    ]
                )
                ->setTableEntries($collection);

            $batch[$type] = $table->make()->getTableContent();
        }

        return $this->view->make($view, compact('type', 'entry', 'batch'));
    }

    /**
     * Toggle the watcher on or off.
     *
     * @param $type
     */
    public function toggle(SettingRepositoryInterface $settings, $type)
    {
        $settings->set(
            'anomaly.module.system::' . $type . '_enabled',
            !config('anomaly.module.system::telescope.watchers.' . $type . '.enabled', false)
        );

        return $this->redirect->back();
    }

    /**
     * Return the view for an email entry.
     *
     * @param EntriesRepository $repository
     * @param $id
     * @return string
     */
    public function message(EntriesRepository $repository, $id)
    {
        $entry = $repository->find($id);

        return $entry->content['html'];
    }

    /**
     * Clear Telescope
     *
     * @param Kernel $console
     * @param EntryModel $model
     * @param null $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear(Kernel $console, EntryModel $model, $type = null)
    {
        if ($type) {
            $model->newQuery()->where('type', str_singular($type))->delete();
        } else {
            $console->call('telescope:clear');
        }

        return $this->redirect->back();
    }

    /**
     * Enable dumps briefly.
     */
    public function dumps()
    {
        cache()->put('telescope:dump-watcher', true, now()->addSecond(10));
    }

}

<?php namespace Anomaly\FilesFieldType\Table;

use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

/**
 * Class FileTableFilters
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileTableFilters
{
    use DispatchesJobs;

    /**
     * @param FileTableBuilder $builder
     * @param FolderRepositoryInterface $folders
     * @param Request $request
     */
    public function handle(
        FileTableBuilder $builder,
        FolderRepositoryInterface $folders,
        Request $request
    ) {
        $allowed = [];

        $config = Crypt::decrypt($request->route('key'));

        foreach (array_get($config, 'folders', []) as $identifier) {

            /* @var FolderInterface $folder */
            if ($folder = $this->dispatch(new GetFolder($identifier))) {
                $allowed[$folder->getId()] = $folder->getName();
            }
        }

        if (!$allowed) {
            $allowed = $folders->all()->pluck('name', 'id')->all();
        }

        $builder
            ->setFilters(
                [
                    'search' => [
                        'columns' => [
                            'name',
                            'keywords',
                            'mime_type',
                        ],
                    ],
                    'folder' => [
                        'exact'   => true,
                        'filter'  => 'select',
                        'options' => $allowed,
                        'enabled' => (count($allowed) !== 1),
                    ],
                ]
            );
    }
}

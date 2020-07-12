# Adventure Log

Adventure Log aims to be a simple but useful tool to help trampers (New Zealand slang for _hikers_) better prepare for their trips by surfacing information about the hut, the track or even availability of firewood.

I have not yet started building the website but the basic goals are this:

- [ ] A database of all hut names
- [ ] ? A database of significant passes/rivers/geographical features
- [ ] A search feature

## Making a Log

- Associated with a hut/geographical feature
- A small text field (?500 char limit)
- Anonymous posts (ability to add your name)
- Has an associated date created
- Has an associated date of log (^ due to long trips)

1. Frontend:
    - Date input (default: today)
    - Message textbox (placeholder: info you might put in)
    - Optional name box
    - Checkbox (I checked my message for typos - there's no backsies!)
    - Submit
2. Honepot is checked
3. Message and name inputs are run through Askimet for spam prevention
4. DB entries added
5. Cache is busted for route
6. Entrie(s) are added to the social media queue table
    - Probably add a queue entry for each social media for each post
7. Form returns (page reloads)

### Other Features

- [ ] RSS feed for each hut/geographical feature
- [ ] RSS feed for NI/SI
- [ ] RSS feed for all NZ
- [ ] ?RSS feed for each region
- [ ] Twitter feed of all logs
- [ ] Auto post to FB? Is there even an API?
- [ ] Huts/geographical features should have a link to their official DOC/Backcountry Huts/whoever website
- [ ] All huts/geographical features should have a link to TopoMap
- [ ] Include a safety message + links to weather services & Intentions form online
- [ ] Report a log as spam/inappropriate
- [ ] Link to Github repo
- [ ] Github sponsors for the repo
- [ ] Page describing all code/data used
    - Probably as a table
- [ ] Page describing privacy (tracking etc.)
- [ ] Page describing best safety practices

### Resources

1. CSS Framework starter: https://github.com/vladocar/Basic.css
2. Server: https://lumen.laravel.com/docs/7.x
3. Facebook API: https://developers.facebook.com/docs/pages/publishing
4. Twitter API: https://developer.twitter.com/en/docs/tweets/post-and-engage/api-reference/post-statuses-update
5. SPAM: https://akismet.com/development/api/
6. Laravel Honeypot: https://github.com/spatie/laravel-honeypot
7. Page caching: https://github.com/JosephSilber/page-cache
8. Laravel Search: https://laravel.com/docs/7.x/collections#method-search
    - Or use Scout and TNTSearch: https://github.com/teamtnt/laravel-scout-tntsearch-driver
9. DOC Datasets: https://catalogue.data.govt.nz/organization/department-of-conservation
10. Logo from Fiverr: https://www.fiverr.com/heroartstudio_/make-awesome-animal-logo-into-my-style?context_referrer=search_gigs&source=top-bar&ref_ctx_id=073d5300-55ff-492f-98b0-47c4b58dc2ed&pckg_id=1&pos=6
11. Register the domain: https://www.hover.com/domains/results?utf8=✓&q=adventurelog.nz

## Contributing

If you have a feature suggestion, bug report or just want to start a discussion about the goals of the application, please [open an issue](https://github.com/finnito/adventure-log/issues/new)!

I'd love to hear from you, honestly!

-- Finn

🏔🏔
![](https://img.shields.io/uptimerobot/ratio/m785755282-f5ee4e9d0e6a7e2d9e757d1d?label=Uptime) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

# Adventure Log

Adventure Log aims to be a simple but useful tool to help trampers (New Zealand slang for _hikers_) better prepare for their trips by surfacing information about the hut, the track or even availability of firewood.

My ethos for web development is _keep it simple, keep it fast_. If you think there is something I can improve, please [open an issue](https://github.com/finnito/adventure-log/issues/new) and let me know!

### Into the Future

- [ ] Post logs to Twitter
- [ ] Post logs to Facebook page

## Contributing

If you have a feature suggestion, bug report or just want to start a discussion about the goals of the application, please [open an issue](https://github.com/finnito/adventure-log/issues/new)!

I'd love to hear from you, honestly!

## Releases

### 1.2 - 2020/08/17

Tonight's little release brings some minor improvements.

- Fixes to the RSS feeds to ensure entries are not overwritten using `->merge()`
- Improvements to the deploy script [#12](https://github.com/finnito/adventure-log/issues/12)
- Minor changes to button copy [#30](https://github.com/finnito/adventure-log/issues/30)
- Added HTML meta tag integration for SEO [#6](https://github.com/finnito/adventure-log/issues/6)
- Removes unused CSS rules for smaller payload [#31](https://github.com/finnito/adventure-log/issues/31)
- Validates the `log_date` input with quick and dirty regex in lieu of a datepicker JS library [#5](https://github.com/finnito/adventure-log/issues/5)
- Adds extra resources to the Safety page.

### 1.1 - 2020/08/14

Tonight's release brings together a series of improvements that I have brainstormed and worked on over the last week.

- Adds styling to targeted anchors throughout the website [#7](https://github.com/finnito/adventure-log/issues/7)
- Adds anchors to individual logs [#7](https://github.com/finnito/adventure-log/issues/7)
- Shows places/areas in the search results [#10](https://github.com/finnito/adventure-log/issues/10)
- Adds a feedback form [#21](https://github.com/finnito/adventure-log/issues/21)
- Adds a GitHub workflow deploy script [#12](https://github.com/finnito/adventure-log/issues/12)
- Fixes clickability of Feedback menu item [#23](https://github.com/finnito/adventure-log/issues/23)
- Disbales pagination of search results [#24](https://github.com/finnito/adventure-log/issues/24)
- Adds a "News" menu link [#20](https://github.com/finnito/adventure-log/issues/20)
- Fixes display of message bag items on page reload [#25](https://github.com/finnito/adventure-log/issues/25)
- Adds RSS feeds for places & huts [#4](https://github.com/finnito/adventure-log/issues/4)
- Add sitemap for all huts to improve cache:warm [#22](https://github.com/finnito/adventure-log/issues/22)
- Adds a basic spam moderation queue + flag as spam button [#13](https://github.com/finnito/adventure-log/issues/13)
- Adds a honeypot field to the Feedback and Log forms [#9](https://github.com/finnito/adventure-log/issues/9)
- Adds a link to the Privacy page
- Significantly updates the README page [#19](https://github.com/finnito/adventure-log/issues/19)
- Expands the mobile nav items [#11](https://github.com/finnito/adventure-log/issues/11)
- Adds a link back to the area from a hut [#29](https://github.com/finnito/adventure-log/issues/29)

With that, I think it is ready for a more public release!

---

### 1.0 - 2020/08/08

This project was thought up during a rainy tramp to Camp Creek Hut and I spent the rest of the road trip pondering on it.

It took a couple of evenings for me to throw together this 1.0 release! It's got two basic features:

1. Search all huts in New Zealand
2. Create a log for a given hut on a given hut

It's time to start this thing up. Refinements and minor features to come in the near future!

![](https://img.shields.io/uptimerobot/ratio/m785755282-f5ee4e9d0e6a7e2d9e757d1d?label=Uptime)
![](https://img.shields.io/github/v/tag/finnito/adventure-log)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/33f7457363954919b61e0d8dcbda2ac2)](https://www.codacy.com/manual/finn_3/adventure-log?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=finnito/adventure-log&amp;utm_campaign=Badge_Grade)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

# Adventure Log

Adventure Log aims to be a simple but useful tool to help trampers (New Zealand slang for _hikers_) better prepare for their trips by surfacing information about the hut, the track or even availability of firewood.

My ethos for web development is _keep it simple, keep it fast_. If you think there is something I can improve, please [open an issue](https://github.com/finnito/adventure-log/issues/new) and let me know!

## Contributing

If you have a feature suggestion, bug report or just want to start a discussion about the goals of the application, please [open an issue](https://github.com/finnito/adventure-log/issues/new)!

I'd love to hear from you, honestly!

## Releases

### 2020.4 (2020/08/25)

- Adds some permissions fixing commands ([commit](https://github.com/finnito/adventure-log/commit/1e7ec91ecc89eeb8320c2cdf76967234a2c4e481))
- (Feat): Groups places index by region ([issue #41](https://github.com/finnito/adventure-log/issues/41), [commit](https://github.com/finnito/adventure-log/commit/34a6baac2f9f6eeb2e66b599fc1210e762e81cfa))
- (Fix): Changes posts slug to /news/ ([issue #44](https://github.com/finnito/adventure-log/issues/44), [commit](https://github.com/finnito/adventure-log/commit/a8f161ddb36bed80d0645192278021759d9b1523))
- (Fix): Simplifies grouping queries ([commit](https://github.com/finnito/adventure-log/commit/c11d8f4cf27770c9a60293d9c54de25f692ef667))
- (Feat): Adds individual log feed to head ([commit](https://github.com/finnito/adventure-log/commit/49bb42c11787077e235b183b3fe6b941e087230f))
- (Feat): Adds author information to RSS feeds ([issue #42](https://github.com/finnito/adventure-log/issues/42), [commit](https://github.com/finnito/adventure-log/commit/f209bb08b446754499e7173cdc44c12e845dfe43))
- (Fix): Properly encodes the RSS content ([commit](https://github.com/finnito/adventure-log/commit/6cf86972d46f7fd59b4bcc317cbd2affafaa7b24))

### 2020.3 (2020/08/21)

- Stops abusing the SemVer scheme ([commit](https://github.com/finnito/adventure-log/commit/680f283f4d5811b6cb061f83ed93a6a981e0833e))
- Re-adds form background color ([commit](https://github.com/finnito/adventure-log/commit/fca980ae5bd698c830856bc52c38ed05f7ef568b))
- Remove usused assets ([commit](https://github.com/finnito/adventure-log/commit/37fb153c3b70ab7de61bdd9bc6af139898cdebc6))
- Clean up ignored files ([commit](https://github.com/finnito/adventure-log/commit/0571a31851d25d9f7f9e5683a086e2b47ed41bb7))
- Stops input elements zooming on mobile ([commit](https://github.com/finnito/adventure-log/commit/b04d56e8699bff95f4c7c708aea5a53edbef9f69))
- Fix the linking and info of logs on the home page ([commit](https://github.com/finnito/adventure-log/commit/5ca67717e0a3e5fe8979269edcf47fdb4250dd13))
- Removes unused code ([commit](https://github.com/finnito/adventure-log/commit/2acb1f2a2e3076d32653c0c85d8d20edd184a338))
- Improves the text encoding in the RSS feed [#38](https://github.com/finnito/adventure-log/issues/38)([commit](https://github.com/finnito/adventure-log/commit/7bcf8d855c670689304a1a745685f840e5384320))
- Adds the master RSS feed to the <head> element [#39](https://github.com/finnito/adventure-log/issues/39) ([commit](https://github.com/finnito/adventure-log/commit/430c18ff95ed5ca8ef56484ca2fd47f86f2da2b0))
- Only deploy to the server on tagged commit ([commit](https://github.com/finnito/adventure-log/commit/8c44f71652f49e1fdd8b3e2dff22b39553261257))
- (Fix) Removes the "related_hut" field; adds autofocus ([commit](https://github.com/finnito/adventure-log/commit/987bc4885d31987997642c49f4bb19c8c9e5642f))
- (Fix) Adds autofocus to the title field [#34](https://github.com/finnito/adventure-log/issues/34) ([commit](https://github.com/finnito/adventure-log/commit/bdbb62fd6fdc8d60a4b3cc7e23b77dfc168a820b))
- (Chore): Simplifies the theme templating ([commit](https://github.com/finnito/adventure-log/commit/bd7ac6482cfd4c261e31bf0a98898acedafae637))
- (Chore): Adds relationships between logs and places ([commit](https://github.com/finnito/adventure-log/commit/78e846aaf97c76208db934ba672785f9103e7f93))
- (Feat): Adds proper ordering of search results [#40](https://github.com/finnito/adventure-log/issues/40) ([commit](https://github.com/finnito/adventure-log/commit/702602a2e95453059672376a7b75d1dfd7bb41e4))
- (Feat): Adds all DOC campsites [#36](https://github.com/finnito/adventure-log/issues/36)([commit](https://github.com/finnito/adventure-log/commit/54a662f825feccf0b0fd5e66108a400d49c12b48))
- Whitespace ([commit](https://github.com/finnito/adventure-log/commit/e23143bbbd2c6f85b92a2a502222c4af2d986ae7))

### 2020/08/17

Tonight's little release brings some minor improvements.

- Fixes to the RSS feeds to ensure entries are not overwritten using `->merge()`
- Improvements to the deploy script [#12](https://github.com/finnito/adventure-log/issues/12)
- Minor changes to button copy [#30](https://github.com/finnito/adventure-log/issues/30)
- Added HTML meta tag integration for SEO [#6](https://github.com/finnito/adventure-log/issues/6)
- Removes unused CSS rules for smaller payload [#31](https://github.com/finnito/adventure-log/issues/31)
- Validates the `log_date` input with quick and dirty regex in lieu of a datepicker JS library [#5](https://github.com/finnito/adventure-log/issues/5)
- Adds extra resources to the Safety page.

### 2020/08/14

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

### 2020/08/08

This project was thought up during a rainy tramp to Camp Creek Hut and I spent the rest of the road trip pondering on it.

It took a couple of evenings for me to throw together this 1.0 release! It's got two basic features:

1. Search all huts in New Zealand
2. Create a log for a given hut on a given hut

It's time to start this thing up. Refinements and minor features to come in the near future!

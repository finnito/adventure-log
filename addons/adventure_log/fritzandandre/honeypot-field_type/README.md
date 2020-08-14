# Honeypot Field Type
This is an extremely simple FT. It adds a field to any form that will cause the form to be invalid if any data is
present in the field.

Essentially, how this works is by adding an input to the form (no column is added to the DB, just a form input) then
using CSS that is not likely to be processed by a spam bot the field is hidden from the user. Spam bots will find the
form element on the page and will fill out every input in the form, including the honey pot field. When the field is
filled then validation will fail and the form will not be submitted.

    <div class="field-group winnie_the_poo">
        <div class="winnie-the-pooh ">
            <label class="control-label">Winnie The Pooh</label>
        <div>
        <input value="" name="winnie_the_pooh" class="form-control " type="text" placeholder="">
    </div>

## Installation
Extract the zip. Move the folder honeypot-field_type into addons/<siteref>/fritzandandre/. Now any form that you add the
honeypot field to will become invalid if any content is entered into the input.

## Suggestion
Some spam bots that are a little more sophisticated will recognize words like "honey pot" or "spam trap" and will not 
fill out those fields. You'll notice that in my demonstration above I've called the field "Winnie The Pooh" as a play
on honey pots. I would also suggest that you use a covert field name to further trick spam bots.

## Why? We already have a captcha field!
Well captcha fields suck! The most recent google captcha that only has you click a single button is much better, but we
can do better! This strategy might be averted by extremely complicated spam bots, but I've always been of the opinion
that websites need to be built to be as easy as possible for users who are using the site. This honeypot field may let
spam through (although in my years of testing I've seen excellent results) but it is as simple as possible for the real
user who is filling out the form.

## Testing
When I worked on the Control4 website a few years ago we read about this strategy of using honeypot fields to get around
spam bots. We implemented it, and our spam was cut down to almost 0, and believe me we were getting a lot of spam on
that website before we implemented it. To their knowledge they have had no false positives as long as the honeypot field
is not visible to actual users.

## Logs
Any submissions that are ignored will be recorded into storage/logs/honeypot_ignored_submissions.log, so no data is ever
lost.
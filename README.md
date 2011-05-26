# Shortnar - Minimal URL Shortener 
Shortnar is a URL shortener that aims to have very little code.

## Why?
From my notes on the project:

> I've decided to write a URL shortener.  Ostensibly because the best free URL
> Shortening software I found with 5 minutes of searching included 3822 lines of
> PHP and I think I could get the features I want in under 100 lines and 3 hours.
> Really of course I'm just doing it to show off.

See the `NOTES` file for more.

## Features

### For the user:
* Give it a URL and it will give you a short URL
* Give it some text and it will give you a short URL
* Go to one of its short URLs and it will redirect you to the URL it was given or return what it was given as plain text.  
It sends the redirect (instead of text) if and only if the given URL starts with one of the strings on the whitelist (e.g. "http://", "ftp://")

### For the administrator:
* Small enough that you can audit every line of PHP
* Easily configurable
* Rudimentary language localisation support

### Not Provided
As part of the minimal philosophy, there is a lot of things it does not do:

* Stats tracking (analyse your webserver logs instead)
* Deleting and Editing URLs (edit the database by hand if necessary)

## Install

See the `INSTALL` file for installation instructions

## Example

Take a look at <http://4gh.es> and <http://4gh.es/5P88x> to see Shortnar in action.

## License

Copyright (c) 2011 Tim Smith <code@abznak.com>

Shortnar is released under the [MIT License](http://www.opensource.org/licenses/mit-license.html).

## Forking, Pull Requests, Support

You are encouraged to fork Shortnar and add features.  As for pull requests, I'll happily accept bug
fix pull requests but a feature would have to be pretty compelling for it to
overcome the minimalism philosophy and be incorporated into my version.  

You're welcome to contact me on GitHub if you're having trouble installing it.

## Future Work
Features I might consider adding:

* simple plugin architecture - Should be doable in under 30 lines
* better localisation - it currently works OK with two languages but could get unwieldy with more.

## FAQ

### Why does it have localisation support if it is supposed to be minimal? 

It seemed polite to have the site in Spanish since I was using Spain's TLD.

### Where does the 4gh in the examples come from?

It's from *The Shockwave Rider* by John Brunner.

## Files

* README.md - this file
* INSTALL.md - installation instructions
* LICENSE - MIT License
* NOTES - some notes I made while writing the project
* www/ - directory containing the code of the project
* Makefile - Some shortcuts I use for testing and deploying.  They're not generic.
* mdtest.s - quick script for testing the markdown, you'll probably need to edit it if you want to use it


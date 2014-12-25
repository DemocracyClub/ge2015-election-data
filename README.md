[![Build Status](https://travis-ci.org/openpolitics/ge2015-election-data.svg)](https://travis-ci.org/openpolitics/ge2015-election-data)

## UK Parliamentary Elections 2015

The results of 2015 UK Parliamentary Elections are due to be announced on Friday 8th May, 2015.

This repo will contain the results by constituency for the UK. We're asking you to help
us collect this data, and use [Cid](https://github.com/theodi/cid) to validate the data when
collaborators submit it.

## Some background

This repo contains two folders, one which will contain CSV files with the votes
each party received by constituency.

## Collaborating

First, [fork the repo](https://github.com/openpolitics/ge2015-election-data/fork), then clone it
to your local machine either on the command line like so:

  	git clone git@github.com:YOUR_USERNMAE/ge2015-election-data.git

or using [Github for Mac](https://mac.github.com/)

Then add two CSV files in the following formats:

### Votes

The votes CSVs should live in the folder /votes and have the following columns:

* Poll Date - Date the poll took place in format YYYY-MM-DD
* Constituency - The name of the parliamentary constituency ([see a list of constituencies](https://openpolitics.github.io/ge2015-election-data/constituencies/constituencies.csv))
* Constituency Code - The [MapIt](http://mapit.mysociety.org/) code for the constituency
* Constituency URL - The MapIt URI for the electoral region
* Party - The name of the party
* Party ID - The Electoral Commision ID of the party ([see a list of IDs](https://openpolitics.github.io/ge2015-election-data/parties/parties.csv))
* Votes - The number of votes for that party
* Ballots Rejected - The number of rejected ballots

The filename should have the format `CONSTITUENCY-NAME-votes.csv`

You can [see an example of what the file should look like here](https://openpolitics.github.io/ge2015-election-data/votes/example-votes.csv)

### Seats

The seats CSVs should live in the folder /seats and have the following columns:

* Poll Date - Date the poll took place in format YYYY-MM-DD
* Constituency - The name of the parliamentary constituency ([see a list of constituencies](https://openpolitics.github.io/ge2015-election-data/constituencies/constituencies.csv))
* Constituency Code - The [MapIt](http://mapit.mysociety.org/) code for the constituency
* Constituency URL - The MapIt URI for the electoral region
* Party - The name of the winning party
* Party ID - The Electoral Commision ID of the winning party ([see a list of IDs](https://openpolitics.github.io/ge2015-election-data/parties/parties.csv))
* Name - The name of the winning candidate
* Address - The address of the winning candidate
* Postcode - The postcode of the winning candidate

The filename should have the format `CONSTITUENCY-NAME-seats.csv`

You can [see an example of what the file should look like here](https://openpolitics.github.io/ge2015-election-data/seats/example-seats.csv)

Once you have made your changes, push them up to your fork, and [open a pull request](https://github.com/openpolitics/ge2015-election-data/compare/).

Our [robots](https://github.com/theodi/cid) will then check the format of the data,
and apply a status to it. If we're happy, we'll merge the changes.

## Pre validation

You can also validate the changes you've made before pushing by running:

  	gem install cid
  	cid validate

If all is well, you should see that each file is valid. If not, make the changes
and try again.

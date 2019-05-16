# Project 4

+ By: Nathaniel Hunt
+ Production URL: p4.nhunt.me

## Feature summary

+ The application serves primarily as an interface to an internal database for a neuroscience lab. In other words, this is an attempt to rebuild an internal lab tool using Laravel (and to add additional features while doing it).
+ Users can get reports of each lab study (divided between local (fMRI) and MTurk studies). These reports reference the relationship between the database tables to show all participants associated with a given study.
+ Users can create studies.
+ Users can create participants.
+ Users can edit studies.
+ Users can search for participants using a searchbox that's a front-end to a SQL query. 
+ Once participants are found, users can either edit the particpant itself, or edit the relationship between a participant and a study. 
+ The pivot table that tracks the (many to many) relationship between studies and participants also stores additional data, allowing to store study/participant run dates and for participants to have different political affiliations in each study (which happens surprisingly often in actual research).

  
## Database summary

+ My application has 3 tables in total (`studies`, `participants`, and the pivot table `particpant_study`).
+ There's a many-to-many relationship between `studies ` and `participants `.

## Outside resources

+ royalty-free image of a brain: https://www.flickr.com/photos/147506298@N05/40447707593/in/photolist-24Ce5hR-7UuP8y-7UuNns-7hxkk-o3EVhm-7UofZZ-8htGTz-nZ6RGY-o3KF16-bgGqFr-Jvcm92-fnWu9d-4B1kLB-aqGU1F-Sn8d2y-RXUc5x-nLhj1p-qxUD3b-RXUbMD-ko8WuX-7UrtDd-21F4fvS-coWuU7-jsjjkY-9xni5o-7UrtW3-cFDuru-6YWvxA-9hiPC-8r4P48-8BU54J-doDHZX-264npDE-8g1MY-4SpukF-EJMigp-Xfugou-DzZ7AL-gX7kp3-fvJu19-c5vkMm-87zpKK-aBzu8F-52QBUS-Ms4Zp-EJMipk-6c4Na4-9S32U-9YTWxn-4ApNSB
+ https://www.w3schools.com/howto/howto_css_dropdown.asp
+ https://laracasts.com/discuss/channels/laravel/save-additional-pivot-table-attributes
+ https://laraveldaily.com/all-about-redirects-in-laravel-5/
+ https://techanical-atom.com/working-with-date-and-time-in-laravel-carbon/
+ https://stackoverflow.com/questions/1161708/php-detect-whitespace-between-strings

## Code style divergences
+ I believe I followed good coding style for most, if not all, of my project. 

## Notes for instructor

+ In case it isn't clear from the above notes, here are the specific ways that this project fulfills the project key requirements:
+ 3 unique CRUD operations *(in general, our lab saves all data, so I didn't prioritize the deletion of data)*: 
	+ Create
	+ Read
	+ Update
+ 1 relationship between 2 tables:
	+ there is a pivot table defining a many-to-many relationship between the `studies` and `participants` tables.
+  I envision the following additional features that set this project apart from `foobooks`:
	+ User ability to manage 2 database tables directly (vs. the single one in `foobooks`).
	+ The pivot table that defines the relationship between the two database tables contains additional data, making it a much more fully-featured database table in its own right (and allowing for additional application features).
	+ Users can directly add relationships between the tables. 
+ Thanks for all your work on this class! I've learned a lot.
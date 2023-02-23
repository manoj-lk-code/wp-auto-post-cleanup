# wp-auto-post-cleanup

Deletes all posts and their associated images that are older than 90 days in your WordPress website.

# Download

You can download plugin zip file.

# cronjob

Make sure your wordpress cronjob is working. 

# Days

You can change number of days in the file.

# Post batch

By default it delete 5 posts. you can change that as well.

# optional but good to use.

In case if images left on wordpress that are older than 90 days, you can use below command to delete all files and folders older than 90 days.

``` 
find /path/to/wp/wp-content/uploads -type f -mtime +90 -delete && find /path/to/wp/wp-content/uploads -type d -empty -delete
```

Here's what this command does:

- find /path/to/wp/wp-content/uploads: starts the find command in the /path/to/wp/wp-content/uploads directory.
- -type f: only looks for files, not directories.
- -mtime +90: only selects files that were modified more than 90 days ago.
- -delete: deletes the selected files.
- The && operator is used to separate two find commands. The second command looks for empty directories (-type d and -empty) and deletes them (-delete) if they are found.


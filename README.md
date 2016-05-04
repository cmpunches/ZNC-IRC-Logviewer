# Log viewer for ZNC by Chris Punches 2016

Views logs stored on server from ZNC bouncer assuming a log directory structure of 

"USER / NETWORK / CHANNEL / DATE.LOG"

It's pretty straight forward to use.  Just set log_path to where the root of your logs are, and configure your ZNC bouncer to log to that path into that structure format.

It converts to html and is fully CSS themeable.  Display is separated from logic and is also fully themeable with smarty templates, so you can basically do anything you want to with this.

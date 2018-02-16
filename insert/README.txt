This text will be used by screen readers, search engines, or when the image cannot be loaded. REQUIRED!

Insert is a utility that inserts allowed images into the form body field.
* This module makes alternate text required for all images. 
* If no alternate text then user will be prompted to enter alternate text when the insert button is pressed.
* If no alternate text is entered if user cuts and pastes an image into the body field then user will 
be prompted with an error message.
* Form can not be saved unless alternate text is entered.
* Leading and trailing spaces are trimmed when using insert image into body function.
* At this time if user cuts and pastes an image and alternate text has leading or trailing spaces those spaces will remain.

Insert was written by Nate Haug.

This Module Made by Robots: http://www.lullabot.com
AND enhanced by Kyle Kelly and Max Headroom.

Dependencies
------------

Insert module does not have any dependencies, but it won't do anything unless
you have at least one File or Image field configured on your site. Both of
these fields are provided by Drupal core.

Recommended
-----------

* WYSIWYG module

Install
-------

1) Copy the insert folder to the modules folder in your installation. Usually
   this is sites/all/modules.

2) In your Drupal site, enable the module under Administer -> Modules
   (/admin/modules).

3) Add or configure a File or Image field under Administer -> Structure ->
   Content types -> [type] -> Manage Fields
   (admin/structure/types/manage/[type]/fields). Once configuring a field,
   there is a new section in the Field options for "Insert". You can then
   configure the field to include an Insert button and what templates you would
   like to have.

4) Create a piece of content with the configured field. After uploading a file,
   an "Insert" button will appear. Click this button to send the file or image
   into the Body field.

Insert should work on multiple fields (the last field that was active will
receive the file), and with most popular WYSIWYG editors.

Theming
-------

Insert can be configured to work with non-HTML filters like BBCode or Markdown.
To do this, copy the template file you would like to change from the "templates"
directory to your active theme's directory. Then empty your Drupal caches at
admin/config/development/performance.

The Image templates may also be used per Image style. You can copy the
image-insert-image.tpl.php file to your theme directory and then rename it to
image-insert-image--[style-name].tpl.php, where [style-name] is the name of the
Image style. Change underscores to hyphens in the style name.

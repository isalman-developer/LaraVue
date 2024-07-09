## Profile Update (Profile Picture)
1. add hover effect to `<img >` under input file (styling)

2. create a ref `fileInput` which is bindied to input of type file.

3. on click img tag, call a function `openFileInput` which will click the `<input type="file" />` to select an image from our device

4. create another function `handFileChange(event)` which will get the selected file from event, a n d create __profilePictureUrl__ which we will display in the img tag. 
    This function will be called at `@change` of input tag.

6. create a migration to add column avatar to users table.

5. after showing image on image input, then use axios to send image to controller to upload it and store it. delete the old picture and update the avatar value of that users.

7. create an accesser for the avatar to return its full url.


## KINDLY NOTE THAT WEHEN YOU CREATE A NEW FOLDER IN STORAGE FOLDER, THEN ADD THAT TO THE FILESYSTEMS IN CONFIG. GO AND CHECKOUT THE FOLDER I HAVE DEFINED INSIDE filesystems.php(config)

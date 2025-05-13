function verif_blog_add() {

    nom = document.getElementById('nom').value.trim()
    image = document.getElementById('image_blog').value.trim()
    type = document.getElementById('type').value.trim()
    description = document.getElementById('description').value.trim()


    // Regular expression for validating username
    var usernameRegex = /^[a-zA-Z0-9_]+$/;

    // Validate username
    if (!usernameRegex.test(nom)) {
        document.getElementById('nomError').innerText = "nom can only contain letters, numbers, and underscores";
        return false;
    } else {
        document.getElementById('nomError').innerText = "";
    }

    if (image == "") {
        document.getElementById('image_blogError').innerText = "image can't be empty";
        return false;
    } else {
        document.getElementById('image_blogError').innerText = "";
    }

    if (type == "") {
        document.getElementById('typeError').innerText = "type can't be empty";
        return false;
    } else {
        document.getElementById('typeError').innerText = "";
    }

    if (description == "") {
        document.getElementById('descriptionError').innerText = "description can't be empty";
        return false;
    } else {
        document.getElementById('descriptionError').innerText = "";
    }

}

function verif_blog_update() {

    nom = document.getElementById('nom').value.trim()
    type = document.getElementById('type').value.trim()
    description = document.getElementById('description').value.trim()


    // Regular expression for validating username
    var usernameRegex = /^[a-zA-Z0-9_]+$/;

    // Validate username
    if (!usernameRegex.test(nom)) {
        document.getElementById('nomError').innerText = "nom can only contain letters, numbers, and underscores";
        return false;
    } else {
        document.getElementById('nomError').innerText = "";
    }

    if (type == "") {
        document.getElementById('typeError').innerText = "type can't be empty";
        return false;
    } else {
        document.getElementById('typeError').innerText = "";
    }

    if (description == "") {
        document.getElementById('descriptionError').innerText = "description can't be empty";
        return false;
    } else {
        document.getElementById('descriptionError').innerText = "";
    }

}

// Function to handle file input change for publication photo
function handlePhotoChange(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {	
      const blogPhoto = document.getElementById('blog_pic_display');
      const hiddenBlogPhotoContainer = document.getElementById('hiddenBlogPhotoContainer');

      // Set the source of hidden publication photo
      document.getElementById('hiddenBlogPhoto').src = e.target.result;

      // Show the hidden publication photo container and hide the displayed photo
      blogPhoto.style.display = 'none';
      hiddenBlogPhotoContainer.style.display = 'block';
    };

    reader.readAsDataURL(file);
  }


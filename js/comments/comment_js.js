function validateCommentForm() {
    var contenu = document.getElementById('contenu_commentaire').value.trim();
    var imageInput = document.getElementById('image_commentaire');
    var imageError = document.getElementById('image_commentaireError');
    var contenuError = document.getElementById('contenu_commentaireError');
    var isValid = true;

    // Validate contenu
    var badWords = ["badword1", "badword2", "badword3"]; // Add your bad words here
    var contenuLower = contenu.toLowerCase();
    var foundBadWord = badWords.some(function(word) {
        return contenuLower.includes(word);
    });
    if (contenu === "") {
        contenuError.innerText = "Comment content can't be empty";
        isValid = false;
    } else if (contenu.length > 100) {
        contenuError.innerText = "Comment content must not exceed 100 characters";
        isValid = false;
    } else if (foundBadWord) {
        contenuError.innerText = "Your comment contains inappropriate language.";
        isValid = false;
    } else {
        contenuError.innerText = "";
    }

    // Validate image (if provided)
    if (imageInput && imageInput.value) {
        var file = imageInput.files[0];
        if (file) {
            var maxSize = 1048576; // 1MB in bytes
            if (file.size > maxSize) {
                imageError.innerText = "Image size must not exceed 1MB";
                isValid = false;
            } else {
                imageError.innerText = "";
            }
        }
    } else if (imageError) {
        imageError.innerText = "";
    }

    return isValid;
}

// Optionally attach to form submit
window.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('commentForm');
    if (form) {
        form.onsubmit = function(e) {
            if (!validateCommentForm()) {
                e.preventDefault();
            }
        };
    }
});
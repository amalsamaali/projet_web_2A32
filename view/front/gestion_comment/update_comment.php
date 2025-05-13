<?php
session_start();
include_once '../../../config.php';
include '../../../Controller/comment_con.php';
include '../../../Model/comment.php';

$commentC = new CommentCon("commentaire");
$error = "";
$comment = null;

if (isset($_GET['id'])) {
    $current_id = $_GET['id'];
    // Fetch the comment to pre-fill the form
    $db = config::getConnexion();
    $stmt = $db->prepare("SELECT * FROM commentaire WHERE id_commentaire = :id");
    $stmt->execute(['id' => $current_id]);
    $comment_data = $stmt->fetch();
    if (!$comment_data) {
        $error = "Comment not found.";
    }
} else {
    $error = "No comment ID provided.";
}

if (
    isset($_POST["id_blog"]) &&
    isset($_POST["contenu_commentaire"])
) {
    if (
        !empty($_POST['id_blog']) &&
        !empty($_POST["contenu_commentaire"])
    ) {
        // Bad words filter
        $badWords = ["bitch", "hoe", "simp", "idiot", "stupid", "dumb", "fool", "moron", "loser", "jerk", "bastard", "asshole", "shit", "crap", "damn", "hell", "bitch", "slut", "whore", "dick", "cock", "piss", "fuck", "fucking", "fucker", "motherfucker", "cunt", "twat", "prick", "wanker", "bollocks", "bugger", "arse", "arsehole", "jackass", "retard", "retarded", "suck", "sucks", "sucker", "pussy", "tit", "boob", "boobs", "nigger", "nigga", "spic", "chink", "gook", "kike", "fag", "faggot", "dyke", "tranny", "queer", "homo", "gay", "lesbo", "slutty", "bastards", "shithead", "shitface", "douche", "douchebag", "scumbag", "skank", "cum", "jizz", "spunk", "balls", "nuts", "testicle", "penis", "vagina", "anus", "butt", "butthole", "craphead", "shitbag", "shitass", "fuckface", "fuckhead", "asswipe", "asshat", "dipshit", "twit", "twithead", "twatwaffle", "dickhead", "dickweed", "pisshead", "pissface", "cockhead", "cockface", "cockbite", "cockmunch", "cocksmoker", "cumdumpster", "cumslut", "cumwhore", "cumface", "cumshot"];
        $contentLower = strtolower($_POST['contenu_commentaire']);
        $foundBadWord = false;
        foreach ($badWords as $word) {
            if (strpos($contentLower, $word) !== false) {
                $foundBadWord = true;
                break;
            }
        }
        if ($foundBadWord) {
            $error = "Your comment contains inappropriate language.";
        } else {
            try {
                $date_commentaire = date('Y-m-d');
                $image_commentaire = '';
                if (isset($_FILES['image_commentaire']) && $_FILES['image_commentaire']['error'] === UPLOAD_ERR_OK) {
                    $image_commentaire = file_get_contents($_FILES['image_commentaire']['tmp_name']);
                } else if (isset($comment_data['image_commentaire'])) {
                    $image_commentaire = $comment_data['image_commentaire'];
                }
                $comment = new Commentaire(
                    $current_id,
                    $_POST['id_blog'],
                    $image_commentaire,
                    $_POST['contenu_commentaire'],
                    $date_commentaire
                );
                if ($commentC->updateComment($comment)) {
                    header('Location: ../gestion blog/blog.php');
                    exit();
                } else {
                    $error = "Failed to update comment";
                }
            } catch (Exception $e) {
                $error = "Error: " . $e->getMessage();
            }
        }
    } else {
        $error = "Missing information";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Comment</title>
    <link rel="stylesheet" href="../gestion blog/blog_add_model_style.css">
</head>
<body>
<div id="idUpdateModal" class="modal" style="display:block;">
    <span onclick="window.location.href='../gestion blog/blog.php'" class="close" title="Close Modal">&times;</span>
    <form id="commentForm" class="modal-content enhanced-modal" action="" method="post" enctype="multipart/form-data" style="max-width:460px;margin:40px auto;background:var(--card-bg,#fff);border-radius:18px;box-shadow:0 8px 48px rgba(34,46,60,0.13);padding:36px 28px 28px 28px;animation:modalIn 0.4s cubic-bezier(.4,2,.6,1) both;">
    <style>
    :root {
        --primary: #2b90d9;
        --primary-dark: #2176ae;
        --accent: #ff6700;
        --accent-dark: #d35400;
        --bg: #f7f9fb;
        --card-bg: #fff;
        --border: #e0e6ed;
        --text-main: #222e3c;
        --text-light: #6c7a89;
        --btn-gradient: linear-gradient(90deg, #2b90d9 0%, #ff6700 100%);
        --btn-gradient-hover: linear-gradient(90deg, #ff6700 0%, #2b90d9 100%);
    }
    .enhanced-modal label {
        font-weight: 600;
        color: var(--primary-dark);
        margin-top: 16px;
        font-size: 1.08rem;
    }
    .enhanced-modal input[type="text"], .enhanced-modal textarea {
        border-radius: 10px;
        border: 1.5px solid var(--border);
        padding: 12px 16px;
        font-size: 1.07rem;
        margin-top: 5px;
        margin-bottom: 10px;
        width: 100%;
        outline: none;
        transition: border 0.2s, box-shadow 0.2s;
        background: #f7f9fb;
    }
    .enhanced-modal textarea:focus, .enhanced-modal input[type="text"]:focus {
        border: 1.5px solid var(--primary);
        box-shadow: 0 2px 12px rgba(43,144,217,0.07);
    }
    .enhanced-modal input[type="file"] {
        border: none;
        margin-top: 4px;
        margin-bottom: 10px;
        background: #f7f7f7;
        border-radius: 8px;
        padding: 8px 0;
    }
    .enhanced-modal .clearfix {
        display: flex;
        gap: 14px;
        margin-top: 24px;
        justify-content: flex-end;
    }
    .enhanced-modal .cancelbtn, .enhanced-modal .deletebtn {
        padding: 12px 28px;
        border: none;
        border-radius: 8px;
        font-size: 1.08rem;
        font-weight: 600;
        cursor: pointer;
        background: var(--btn-gradient);
        color: #fff;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        position: relative;
        overflow: hidden;
    }
    .enhanced-modal .cancelbtn:hover, .enhanced-modal .deletebtn:hover {
        background: var(--btn-gradient-hover);
        box-shadow: 0 8px 32px rgba(255,103,0,0.12);
    }
    .enhanced-modal .cancelbtn .btn-ripple, .enhanced-modal .deletebtn .btn-ripple {
        position: absolute;
        border-radius: 50%;
        transform: scale(0);
        animation: ripple 0.6s linear;
        background: rgba(255,255,255,0.5);
        pointer-events: none;
        width: 120%;
        height: 120%;
        left: -10%;
        top: -10%;
        z-index: 1;
    }
    @keyframes ripple {
        to { transform: scale(2.5); opacity: 0; }
    }
    @keyframes modalIn {
        0% { transform: scale(0.8) translateY(80px); opacity: 0; }
        100% { transform: scale(1) translateY(0); opacity: 1; }
    }
    </style>
    <div class="container" style="padding:0;">
        <h1 style="font-family:'Poppins',sans-serif;font-weight:700;color:var(--primary);font-size:2rem;margin-bottom:8px;">Modifier le commentaire</h1>
        <p style="color:var(--text-light);margin-bottom:18px;">Modifiez votre avis ci-dessous</p>
        <hr style="margin-bottom:20px;">
        <input type="hidden" name="id_blog" value="<?php echo htmlspecialchars($comment_data['id_blog'] ?? ''); ?>">
        <label for="contenu_commentaire">Votre commentaire</label>
        <textarea name="contenu_commentaire" id="contenu_commentaire" cols="30" rows="5" required style="resize:vertical;"><?php echo htmlspecialchars($comment_data['contenu_commentaire'] ?? ''); ?></textarea>
        <div id="contenu_commentaireError" style="color:red;"></div>
        <label for="image_commentaire">Image (optionnel)</label>
        <input type="file" id="image_commentaire" name="image_commentaire" accept="image/*" class="form-input" />
        <div id="image_commentaireError" style="color:red;"></div>
        <?php if (!empty($comment_data['image_commentaire'])): ?>
            <div style="margin-bottom:10px;"><img src="data:image/jpeg;base64,<?php echo base64_encode($comment_data['image_commentaire']); ?>" alt="Current Image" style="max-width:100px;max-height:100px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.07);" /></div>
        <?php endif; ?>
        <hr style="margin-top:20px;margin-bottom:18px;">
        <div class="clearfix">
            <input type="submit" class="cancelbtn" name="updatebtn" id="updatebtn" value="Mettre à jour" onmousedown="addRipple(event,this)">
            <button type="button" class="deletebtn" onclick="window.location.href='../gestion blog/blog.php'" onmousedown="addRipple(event,this)">Annuler</button>
        </div>
        <?php if (!empty($error)): ?>
            <div style="color:var(--accent);margin-top:14px;font-weight:600;"> <?php echo $error; ?> </div>
        <?php endif; ?>
    </div>
    <script>
    // Ripple effect for buttons
    function addRipple(e, btn) {
        var ripple = document.createElement('span');
        ripple.className = 'btn-ripple';
        var rect = btn.getBoundingClientRect();
        ripple.style.left = (e.clientX - rect.left) + 'px';
        ripple.style.top = (e.clientY - rect.top) + 'px';
        btn.appendChild(ripple);
        setTimeout(function(){ ripple.remove(); }, 700);
    }
    </script>
</form>
</div>
</body>
</html>
<script src="../../../js/comments/comment_js.js"></script>
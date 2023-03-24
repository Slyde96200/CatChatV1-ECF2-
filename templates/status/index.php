<?php
require_once('libraries/Database.php');

$date = date('d-m-Y H:i:s');
$user_id = isset($_SESSION['username_login']) ? $_SESSION['username_login']['id'] : "";

if (!empty($_POST['content']) && !empty($user_id)) {
    $content = $_POST['content'];
/*     $media_url = "";
    $media_type = ""; */


  /*  if (!empty($_FILES['fileToUpload']['name'])) {
        $target_dir = "../media/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_image_types = ["jpg", "jpeg", "png", "gif"];
        $allowed_video_types = ["mp4", "mov", "avi", "wmv", "flv", "webm"];

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            if (!in_array($fileType, $allowed_video_types)) {
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 50000000) {
            $uploadOk = 0;
        }

        if (
            !in_array($fileType, $allowed_image_types) &&
            !in_array($fileType, $allowed_video_types)
        ) {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Désolé, votre fichier n'a pas été téléchargé.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $media_url = $target_file;
                $media_type = in_array($fileType, $allowed_image_types) ? "image" : "video";
            } else {
                echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            }
        }
    }
 */
    $db->query("INSERT INTO status (content, user_id) VALUES ('$content', '$user_id')");
    if ($db->error) {
        echo "Erreur : " . $db->error;
    } else {
        echo "Message ajouté avec succès";
    }

    header("Location:index.php");
}
?>

<?php if (Session::isConnected()) : ?>

    <form action="index.php?controller=status&task=upload" method="POST" id="write-status" enctype="multipart/form-data" name="mon-formulaire">
        <div class="form-row">
            <textarea name="content" id="content" required placeholder="Un nouveau topic ?"></textarea>
        </div>
       <!--  <div class="form-row">
            <label for="fileToUpload">Sélectionner une image descriptive du topic :</label>
            <input type="file" name="fileToUpload" id="fileToUpload" class="chooseFile">
        </div>
        <div class="form-row">
            <img id="imagePreview" src="" style="max-width: 60%; border-radius: 15px;">
            <video id="videoPreview" width="300" height="220" style="max-width: 60%; border-radius: 15px;"></video>
        </div> -->
        <button type="submit" name="submit">
            <i class="blbl"></i>
            Ouvrir le topic
        </button>
    </form><br>

    <script>
        const fileInput = document.querySelector("#fileToUpload");
        const imagePreview = document.querySelector("#imagePreview");
        const videoPreview = document.querySelector("#videoPreview");

        fileInput.addEventListener("change", (event) => {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.addEventListener("load", (event) => {
                if (file.type.match('image.*')) {
                    imagePreview.style.display = 'block';
                    videoPreview.style.display = 'none';
                    imagePreview.src = event.target.result;
                } else if (file.type.match('video.*')) {
                    imagePreview.style.display = 'none';
                    videoPreview.style.display = 'block';
                    videoPreview.src = event.target.result;
                }
            });

            reader.readAsDataURL(file);
        });
    </script>
<?php endif ?>

<h2>Topics:</h2>
<section id="status">
    
    <?php foreach ($status as $stat) : ?>
        <h2><?= $stat['content'] ?></h2><br>
        <article>
            <figure>

                <div class="metadata">
                    <small>Le <?= $stat['createdAt'] ?></small> |
                    <a href="index.php?controller=status&task=show&id=<?= $stat['id'] ?>">
                        <i class="ri-chat-3-line"></i> <strong><?= $stat['comments'] ?></strong> réponses
                    </a>
                </div>
            </div>
        </article>
    <?php endforeach ?>
</section>

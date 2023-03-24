<section id="status">
  <article>
    <figure>
      <img src="<?= $status['avatar'] ?>" class="avatar" alt="Avatar de <?= $status['firstName'] ?> <?= $status['lastName'] ?>" />
    </figure>
    <div class="details">
      <strong><?= $status['firstName'] ?> <?= $status['lastName'] ?></strong>
      <p><?= $status['content'] ?></p>
      <img src="<?= $status['media_url'] ?>" style="max-width: 60%;" id="mon-image-affiche">
      <source src="<?= $status['media_url'] ?>" type="video/webm">
      <div class="metadata">
        <small>Le <?= $status['createdAt'] ?></small> |
        <i class="far fa-comments"></i>
        <strong><?= $status['comments'] ?></strong> Réponses |
        <a href="index.php?controller=status&task=edit&id=<?= $status['id'] ?>">
          <i class="ri-edit-line"></i> Modifier
        </a> |
        <a href="index.php?controller=status&task=delete&id=<?= $status['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce statut ?');">
          <i class="ri-delete-bin-line"></i>
          Supprimer
        </a>

      </div>
    </div>
  </article>
</section>


<section id="comments">
  <h2>
    <?= count($comments) ?>
    Réponses :
  </h2>

  <?php foreach ($comments as $comment) : ?>
    <div class="comment">
      <figure>
        <img src="<?= $comment['avatar'] ?>" alt="" class="avatar" />
      </figure>
      <div class="details">
        <h4>
          <?= $comment['firstName'] ?>
          <?= $comment['lastName'] ?>
        </h4>
        <small>
          Le
          <?= $comment['createdAt'] ?>
        </small>
        <blockquote>
          <?= $comment['content'] ?>
          <br /><br />
          <form action="index.php?controller=comments&amp;task=delete" method="post" class="form-supp" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">
            <input type="hidden" name="id" value="<?= $comment['id'] ?>">
            <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-line"></i> Supprimer</button>
          </form>

        </blockquote>
      </div>
    </div>
  <?php endforeach ?>
</section>

<?php if (Session::isConnected()) : ?>
  <form action="index.php?controller=comments&task=save" method="post">
    <h2>Répondre à ce topic</h2>
    <div class="form-row">
      <textarea name="content" id="content" rows="3" placeholder="Réponse au topic "></textarea>
    </div>
    <button type="submit">
      <i class="ri-chat-3-line"></i>
      répondre
    </button>

    <input type="hidden" name="status_id" value="<?= $status['id'] ?>" />
  </form>
<?php else : ?>
  <h2>Connectez vous pour répondre</h2>
  <?php require_once 'templates/users/form-login.php' ?>
<?php endif ?>
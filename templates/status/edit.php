<form action="index.php?controller=status&task=update" method="post">
    <h1>Modifier un topic:</h1>
    <div class="form-row">
        <label for="content">Contenu :</label>
        <textarea name="content" id="content" rows="5" placeholder="Le contenu du statut ..."><?=$status['content']?></textarea>
    </div>
    <input type="hidden" name="id" value="<?=$status['id']?>">
    <button type="submit">
        <i class="fas fa-check"></i>&nbsp;
        Je confirme
    </button>
</form>
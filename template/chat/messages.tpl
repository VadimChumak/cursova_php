
<div class="col l4 m4" id="usersMessages">
    <?php while (!is_null($item = array_shift($messagesArray))): ?>
        <div class="chip col l12 m12 s12">
            <input type="hidden" value="<?php echo $item['user_id'] ?>" />
            <img src="/media/users/<?php echo $item['user_id'] ?>/photos/<?php echo $item['image'] ?>"/>
            <?php echo $item['surname']." ".$item['name'] ?>
        </div>
    <?php endwhile; ?>
</div>
<div class="col l8 m8" id="messagesSection">
<div class="col l12 m12" id="textMessages">

</div>
 <div class="row">
        <form class="col l12 m12 s12" name="formMessage">
            <div class="row">
                <div class="input-field l12 m12 s12">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="icon_prefix2" class="materialize-textarea" name="text"></textarea>
                    <label for="icon_prefix2">Що у вас нового</label>
                </div>
                <div class="input-field l12 m12 s12">
                    <button class="modal-action modal-close waves-effect waves-green btn-flat main-color" id="sendMessages">Agree</button>
                </div>
            </div>
        </form>
      </div>
</div>
<script type="text" id="messageItem">
<div class="col l12 m12 s12">
    <p class="[align]">[text]</p>
</div>
</script>
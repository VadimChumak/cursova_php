
<div class="col l4 m4" id="usersMessages">
<ul class="collection card">
    <?php while (!is_null($item = array_shift($messagesArray))): ?>
        <li class="collection-item avatar">
            <input type="hidden" value="<?php echo $item['user_id'] ?>" />
            <img src="/media/users/<?php echo $item['user_id'] ?>/photos/<?php echo $item['image'] ?>" alt="" class="circle">
            <span class="title"><?php echo $item['surname'].' '.$item['name'] ?></span>
        </li>
    <?php endwhile; ?>
  </ul>
</div>
<div class="col l8 m8" id="messagesSection">
<div class="col l12 m12 card white" id="textMessages">

</div>
 <div class="row">
        <form class="col l12 m12 s12 card" name="formMessage">
            <div class="row">
                <div class="input-field l12 m12 s12">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="icon_prefix2" class="materialize-textarea" name="text"></textarea>
                    <label for="icon_prefix2">Повідомлення</label>
                </div>
                <div class="input-field l12 m12 s12">
                    <button class="modal-action modal-close waves-effect waves-green btn-flat main-color" id="sendMessages">Agree</button>
                </div>
            </div>
        </form>
      </div>
</div>
<script type="text" id="messageItem">
    <div class="message [sender]">
        <span class="message-item">[text]</span>
        <span class="date">[date]</span>
    </div>
</script>
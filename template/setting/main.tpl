<div class="col l12 m12 s12 edit-user-data">
    <div class="card">
<form class="white"  method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="input-field col offset-l2 l8 m12">
            <input type="date" class="datepicker" id="birthday" name="birthday" value="<?=$UserInfo['birthday']?>">
            <label for="birthday">Birthday</label>
        </div>
      </div>
    <div class="row">
        <div class="input-field col offset-l2 l8 m12">
            <p>
                <input class="with-gap" name="gender" value="1" type="radio" id="test4" <?php if ($UserInfo['gender'] == 1) echo 'checked' ?> />
                <label for="test4">Male</label>
            </p>
            <p>
                <input class="with-gap" name="gender" value="0" type="radio" id="test5" <?php if ($UserInfo['gender'] == 0) echo 'checked' ?> />
                <label for="test5">Female</label>
            </p>
        </div>
      </div>
    <div class="row">
        <div class="input-field col offset-l2 l8 m12">
          <textarea id="textarea1" class="materialize-textarea" name="about"><?=$UserInfo['about']?></textarea>
          <label for="textarea1">About</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col offset-l2 l8 m12">
          <input id="country" type="text" name="country" value="<?=$UserInfo['country']?>">
          <label for="country">Country</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col offset-l2 l8 m12">
          <input id="city" type="text" name="city" value="<?=$UserInfo['city']?>">
          <label for="city">City</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col offset-l2 l8 m12" id="floating-panel">
            <h5>Location: </h5>
            <input id="address" type="text" value="<?=$UserInfo['city']?>">
            <input id="submitGeo" type="button" value="Geocode">
            <div id="map"></div>
        </div>
      </div>
      <div class="row">
        <div class="input-field col offset-l2 l8 m12">
          <input type="submit" class="btn" value="Save">
        </div>
      </div>
</form>
</div>
</div>
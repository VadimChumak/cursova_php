<form class="white" action="" method="post" enctype="multipart/form-data">
    <div>Birthday: <input type="date" name="birthday" value="<?=$UserInfo['birthday']?>"></div>
    <div>Male : <input <?php if ($UserInfo['gender'] == 1) echo 'checked' ?>  type="radio" name="gender" value="1"> Female : <input <?php if ($UserInfo['gender'] == 0) echo 'checked' ?> type="radio" name="gender" value="0"></div>
    <div>Country: <input type="text" name="country" value="<?=$UserInfo['country']?>"></div>
    <div>City: <input type="text" name="city" value="<?=$UserInfo['city']?>"></div>
    <div>Image: <input name="photo" type="file" accept="image/*"></div>
    <div>About : <textarea name="about" cols="30" rows="10"><?=$UserInfo['about']?></textarea></div>
    <div><input type="submit" value="Зберегти"></div>
</form>
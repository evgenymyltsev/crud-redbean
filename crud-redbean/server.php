<?php
  $db = new PDO('mysql:host=localhost;dbname=ajaxdata', 'root', '');
  $page = isset($_GET['p'])?$_GET['p']:'';
  if($page == 'add'){
    $name = $_POST['nm'];
    $email = $_POST['em'];
    $phone = $_POST['hp'];
    $address = $_POST['al'];
    $stmt = $db->prepare('insert into crud values("", ?, ?, ?, ?)');
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $phone);
    $stmt->bindParam(4, $address);
    if($stmt->execute()) {
      echo 'Success add data';
    } else {
      echo
       'Fail add data';
    }
  } else if ($page == 'edit') {
    $id = $_POST['id'];
    $name = $_POST['nm'];
    $email = $_POST['em'];
    $phone = $_POST['hp'];
    $address = $_POST['al'];
    $stmt = $db->prepare('update crud set name=?, email=?, phone=?, address=? where id=?');
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $phone);
    $stmt->bindParam(4, $address);
    $stmt->bindParam(5, $id);
    if($stmt->execute()) {
      echo 'Success update data';
    } else {
      echo
       'Fail update data';
    }

  } else if($page == 'del') {
    $id = $_GET['id'];
    $stmt = $db->prepare('delete from crud where id=?');
    $stmt->bindParam(1, $id);
    if ($stmt->execute()) {
      echo 'Success delete data';
    } else {
      echo
       'Fail delete data';
    }
  } else {
    $stmt = $db->prepare('select * from crud order by id desc');
    $stmt->execute();
    while ($row = $stmt->fetch()) {
       ?>
        <tr>
          <td><?php echo $row['id'] ?></td>
          <td><?php echo $row['name'] ?></td>
          <td><?php echo $row['email'] ?></td>
          <td><?php echo $row['phone'] ?></td>
          <td><?php echo $row['address'] ?></td>
          <td>
            <button class="btn btn-warning" data-toggle="modal" data-target="#edit-<?php echo $row['id'] ?>">Edit</button>
            <div class="modal fade" id="edit-<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editLabel-<?php echo $row['id'] ?>">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editLabel-<?php echo $row['id'] ?>">Edit Data</h4>
                  </div>
                  <form>
                    <div class="modal-body">
                      <input type="hidden" id="<?php echo $row['id'] ?>" value="<?php echo $row['id'] ?>">
                      <div class="form-group">
                        <label for="nm">Full name</label>
                        <input type="text" class="form-control" id="nm-<?php echo $row['id'] ?>" value="<?php echo $row['name'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="em">E-mail</label>
                        <input type="email" class="form-control" id="em-<?php echo $row['id'] ?>" value="<?php echo $row['email'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="hp">Phone number</label>
                        <input type="tel" class="form-control" id="hp-<?php echo $row['id'] ?>" value="<?php echo $row['phone'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="al">Address</label>
                        <textarea name="name" rows="8" cols="80" type="text" class="form-control" id="al-<?php echo $row['id'] ?>" placeholder="Enter address"><?php echo $row['address'] ?></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="updateData" data-id="<?php echo $row['id'] ?>" class="btn btn-primary">Update</button>
                      <!-- <button type="submit" onclick="updateData(<?php echo $row['id'] ?>)" class="btn btn-primary">Update</button> -->
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <button onclick="deleteData(<?php echo $row['id'] ?>)" class="btn btn-danger">Delete</button>
          </td>
        </tr>
      <?php
    }
  }
?>

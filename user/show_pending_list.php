<?php
require_once('../.confiq/confiq.php');
$session = session_auth_check($connect);
if ($session['session_valid'] && $session['auth_key_valid']) {
  $retreive_all_billinglist = $connect->query("select * from billinglist where status='pending'");
  if (!empty($retreive_all_billinglist->num_rows)) {
    while ($billing_row = $retreive_all_billinglist->fetch_assoc()) {
      ?>
      <div class="tabcontent__field">
        <span class="tabcontent__user">
          <p>User: <?php echo $billing_row['userid']; ?></p>
        </span>
        <span class="tabcontent__key">
          <p>Key: <?php echo $billing_row['keyhash']; ?></p>
        </span>
        <span class="tabcontent__action">
          <button class="button__icon button__blue" id="view" data-key="<?php echo $billing_row['keyhash']; ?>"><i class="fas fa-location-arrow"></i>View</button>
          <button class="button__icon button__green" id="approve" data-key="<?php echo $billing_row['keyhash']; ?>"><i class="fas fa-location-arrow"></i>Mark as done</button>
        </span>
      </div>
      <?php
    }
  } else {
    ?>
    <p class="cart__no__result">No pending list found. Yay!</p>
    <?php
  }
} else {
  echo "";
}
$connect->close();
?>

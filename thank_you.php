<!-- ============================================================
     MODRAZE — Order Success Page
     Drop between header.php and footer.php
============================================================ -->
<?php
include "./sql/conn.php";
include "./includes/header.php";
$order = @$_SESSION['order_no'];
$total = @$_SESSION['total'];


$query = "SELECT * FROM `order_user` WHERE `order_no`='$order'";
$sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<section class="mod-success-section" aria-label="Order Confirmation">
  <div class="container">

    <!-- HERO CARD -->
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8">
        <article class="mod-hero-card mod-fade-in" aria-labelledby="mod-hero-heading">

          <!-- Success Icon -->
          <div class="mod-icon-wrap" aria-hidden="true">
            <div class="mod-icon-ring mod-ring-outer"></div>
            <div class="mod-icon-ring mod-ring-inner"></div>
            <div class="mod-icon-circle">
              <i class="fas fa-check mod-check-icon"></i>
            </div>
          </div>

          <h1 class="mod-hero-heading" id="mod-hero-heading">Thank You For Your Order!</h1>
          <p class="mod-hero-sub">Your order has been placed successfully and is now being processed.</p>

          <!-- Meta Badges -->
          <div class="mod-meta-row">
            <div class="mod-meta-badge">
              <i class="fas fa-hashtag" aria-hidden="true"></i>
              <span class="mod-meta-label">Order</span>
              <strong> <?php echo @$order     ?></strong>
            </div>
            <div class="mod-meta-badge">
              <i class="far fa-calendar-alt" aria-hidden="true"></i>
              <span class="mod-meta-label">Date</span>
              <strong id="mod-order-date">—</strong>
            </div>
            <div class="mod-meta-badge">
              <i class="fas fa-truck" aria-hidden="true"></i>
              <span class="mod-meta-label">Est. Delivery</span>
              <strong>3–5 Business Days</strong>
            </div>
          </div>

        </article>
      </div>
    </div>

    <!-- ORDER SUMMARY -->
    <div class="row justify-content-center mod-fade-in mod-delay-2">
      <div class="col-12 col-md-10">
        <div class="mod-summary-card">
          <h2 class="mod-section-title">Order Summary</h2>
          <ul class="mod-summary-list" role="list">

            <li class="mod-summary-row">
              <div class="mod-summary-icon-wrap"><i class="fas fa-receipt"></i></div>
              <div class="mod-summary-info">
                <span class="mod-summary-key">Order Number</span>
                <span class="mod-summary-val"><?php echo @$order    ?></span>
              </div>
            </li>

            <li class="mod-summary-row">
              <div class="mod-summary-icon-wrap"><i class="fas fa-credit-card"></i></div>
              <div class="mod-summary-info">
                <span class="mod-summary-key">Payment Method</span>
                <span class="mod-summary-val"><?php echo $row['payment_method']    ?></span>
              </div>
            </li>

            <li class="mod-summary-row">
              <div class="mod-summary-icon-wrap"><i class="fas fa-tag"></i></div>
              <div class="mod-summary-info">
                <span class="mod-summary-key">Total Amount</span>
                <span class="mod-summary-val mod-summary-val--price"><?php echo @$total    ?> PKR</span>
              </div>
            </li>

            <li class="mod-summary-row">
              <div class="mod-summary-icon-wrap"><i class="fas fa-map-marker-alt"></i></div>
              <div class="mod-summary-info">
                <span class="mod-summary-key">Shipping Address</span>
                <span class="mod-summary-val"><?php echo $row['od_address']    ?></span>
              </div>
            </li>

            <li class="mod-summary-row mod-summary-row--last">
              <div class="mod-summary-icon-wrap"><i class="fas fa-envelope"></i></div>
              <div class="mod-summary-info">
                <span class="mod-summary-key">Confirmation Sent To</span>
                <span class="mod-summary-val"><?php echo $row['od_email']    ?></span>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </div>

    <!-- ACTION BUTTONS -->
    <div class="row justify-content-center mod-fade-in mod-delay-3">
      <div class="col-12 col-md-10">
        <div class="mod-actions">
          <a href="shop.php" class="mod-btn mod-btn--primary">
            <i class="fas fa-shopping-bag"></i> Continue Shopping
          </a>
          <a href="profile.php" class="mod-btn mod-btn--secondary">
            <i class="fas fa-list-alt"></i> View Orders
          </a>
          <a href="contact.php" class="mod-btn mod-btn--outline">
            <i class="fas fa-headset"></i> Contact Support
          </a>
        </div>
      </div>
    </div>

  </div>
</section>

<?php
include "./includes/footer.php";
?>

<script>
  window.addEventListener('beforeunload', function() {
    navigator.sendBeacon('./handlers/clear_session.php');
  });
  
  // Inject today's date
  
  (function() {
    var el = document.getElementById('mod-order-date');
    if (el) {
      var d = new Date();
      var m = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
      el.textContent = m[d.getMonth()] + ' ' + d.getDate() + ', ' + d.getFullYear();
    }
  })();
</script>

<style>
  /* ── Tokens ── */
  :root {
    --mod-red: #E53637;
    --mod-red-dark: #c0292a;
    --mod-black: #111111;
    --mod-white: #FFFFFF;
    --mod-green: #22c55e;
    --mod-green-glow: rgba(34, 197, 94, .18);
    --mod-bg: #f8f7f5;
    --mod-border: #ebebeb;
    --mod-muted: #7a7a7a;
    --mod-shadow: 0 6px 28px rgba(0, 0, 0, .09);
    --mod-radius: 18px;
    --mod-ease: .28s cubic-bezier(.4, 0, .2, 1);
  }

  /* ── Section ── */
  .mod-success-section {
    background: var(--mod-bg);
    padding: 60px 0 80px;
    font-family: "Nunito Sans", sans-serif;
  }

  /* ── Fade-in ── */
  .mod-fade-in {
    opacity: 0;
    transform: translateY(20px);
    animation: modFadeUp .6s ease forwards;
  }

  .mod-delay-2 {
    animation-delay: .18s;
  }

  .mod-delay-3 {
    animation-delay: .32s;
  }

  @keyframes modFadeUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* ── Hero Card ── */
  .mod-hero-card {
    background: var(--mod-white);
    border-radius: var(--mod-radius);
    box-shadow: var(--mod-shadow);
    padding: 52px 36px 44px;
    text-align: center;
    margin-bottom: 24px;
  }

  /* Icon */
  .mod-icon-wrap {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100px;
    height: 100px;
    margin: 0 auto 28px;
  }

  .mod-icon-ring {
    position: absolute;
    border-radius: 50%;
    animation: modRing 2.4s ease-in-out infinite;
  }

  .mod-ring-outer {
    inset: -10px;
    border: 2px solid rgba(34, 197, 94, .20);
  }

  .mod-ring-inner {
    inset: -3px;
    border: 2px solid rgba(34, 197, 94, .38);
    animation-delay: .4s;
  }

  @keyframes modRing {

    0%,
    100% {
      opacity: 1;
      transform: scale(1);
    }

    50% {
      opacity: .4;
      transform: scale(1.07);
    }
  }

  .mod-icon-circle {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 28px var(--mod-green-glow);
    animation: modBounce .65s cubic-bezier(.36, .07, .19, .97) both;
  }

  @keyframes modBounce {
    0% {
      transform: scale(0) rotate(-45deg);
    }

    65% {
      transform: scale(1.1) rotate(5deg);
    }

    85% {
      transform: scale(.95) rotate(-3deg);
    }

    100% {
      transform: scale(1) rotate(0);
    }
  }

  .mod-check-icon {
    color: #fff;
    font-size: 1.9rem;
  }

  /* Hero text */
  .mod-hero-heading {
    font-size: clamp(1.4rem, 4vw, 2rem);
    font-weight: 800;
    color: var(--mod-black);
    letter-spacing: -.4px;
    margin-bottom: 10px;
  }

  .mod-hero-sub {
    font-size: .95rem;
    color: var(--mod-muted);
    max-width: 400px;
    margin: 0 auto 28px;
    line-height: 1.7;
  }

  /* Meta badges */
  .mod-meta-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
  }

  .mod-meta-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: var(--mod-bg);
    border: 1px solid var(--mod-border);
    border-radius: 50px;
    padding: 7px 16px;
    font-size: .8rem;
    font-weight: 600;
    color: var(--mod-black);
    transition: border-color var(--mod-ease), background var(--mod-ease);
  }

  .mod-meta-badge:hover {
    border-color: var(--mod-red);
    background: rgba(229, 54, 55, .04);
  }

  .mod-meta-badge i {
    color: var(--mod-red);
    font-size: .72rem;
  }

  .mod-meta-label {
    color: var(--mod-muted);
    font-weight: 400;
  }

  /* ── Summary Card ── */
  .mod-summary-card {
    background: var(--mod-white);
    border-radius: var(--mod-radius);
    box-shadow: var(--mod-shadow);
    padding: 32px 36px;
    margin-bottom: 24px;
    transition: box-shadow var(--mod-ease);
  }

  .mod-summary-card:hover {
    box-shadow: 0 12px 40px rgba(0, 0, 0, .12);
  }

  .mod-section-title {
    font-size: .8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--mod-muted);
    margin-bottom: 24px;
  }

  .mod-summary-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .mod-summary-row {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 14px 6px;
    border-bottom: 1px solid var(--mod-border);
    border-radius: 8px;
    margin: 0 -6px;
    transition: background var(--mod-ease);
  }

  .mod-summary-row:hover {
    background: rgba(229, 54, 55, .03);
  }

  .mod-summary-row--last {
    border-bottom: none;
  }

  .mod-summary-icon-wrap {
    width: 36px;
    height: 36px;
    background: rgba(229, 54, 55, .08);
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: var(--mod-red);
    font-size: .85rem;
  }

  .mod-summary-info {
    display: flex;
    flex-direction: column;
    gap: 3px;
  }

  .mod-summary-key {
    font-size: .72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--mod-muted);
  }

  .mod-summary-val {
    font-size: .92rem;
    font-weight: 600;
    color: var(--mod-black);
    line-height: 1.5;
  }

  .mod-summary-val--price {
    color: var(--mod-red);
    font-size: 1.05rem;
    font-weight: 800;
  }

  /* ── Buttons ── */
  .mod-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
    margin-bottom: 16px;
  }

  .mod-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 26px;
    border-radius: 50px;
    font-family: "Nunito Sans", sans-serif;
    font-size: .88rem;
    font-weight: 700;
    letter-spacing: .3px;
    text-decoration: none;
    border: 2px solid transparent;
    transition: background var(--mod-ease), color var(--mod-ease),
      border-color var(--mod-ease), transform var(--mod-ease),
      box-shadow var(--mod-ease);
  }

  .mod-btn:hover {
    transform: translateY(-2px);
    text-decoration: none;
  }

  .mod-btn--primary {
    background: var(--mod-red);
    color: var(--mod-white);
    box-shadow: 0 5px 18px rgba(229, 54, 55, .28);
  }

  .mod-btn--primary:hover {
    background: var(--mod-red-dark);
    color: var(--mod-white);
    box-shadow: 0 8px 24px rgba(229, 54, 55, .38);
  }

  .mod-btn--secondary {
    background: var(--mod-black);
    color: var(--mod-white);
    box-shadow: 0 5px 18px rgba(0, 0, 0, .16);
  }

  .mod-btn--secondary:hover {
    background: #2a2a2a;
    color: var(--mod-white);
  }

  .mod-btn--outline {
    background: transparent;
    color: var(--mod-black);
    border-color: var(--mod-border);
  }

  .mod-btn--outline:hover {
    border-color: var(--mod-red);
    color: var(--mod-red);
    background: rgba(229, 54, 55, .04);
  }

  /* ── Mobile ── */
  @media (max-width: 767.98px) {

    .mod-hero-card,
    .mod-summary-card {
      padding: 36px 20px 32px;
    }

    .mod-btn {
      width: 100%;
      justify-content: center;
    }
  }
</style>
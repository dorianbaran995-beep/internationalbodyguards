<?php
$sent = isset($_GET['sent']) && $_GET['sent'] === '1';
$error = isset($_GET['error']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Request Protection | International Bodyguards</title>
  <meta name="description" content="Submit a confidential request for bodyguard, family, travel or executive protection services.">
  <link rel="canonical" href="https://internationalbodyguards.net/request-protection/">
  <link rel="icon" href="/assets/favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="/assets/style.css">
  <script src="/assets/request-form.js" defer></script>
</head>
<body>
  <main class="requestPage">
    <header class="siteHeader requestSiteHeader">
      <a class="brand" href="/" aria-label="International Bodyguards home">
        <img src="/assets/international-bodyguards-brand-crisp.webp" alt="" class="brandMark">
        <span><strong>International Bodyguards</strong><small>Hong Kong · Worldwide</small></span>
      </a>
      <nav class="desktopNav" aria-label="Primary navigation">
        <a href="/#services">Services</a>
        <a href="/#coverage">Coverage</a>
        <a href="/#approach">Approach</a>
        <a href="/#standards">Standards</a>
      </nav>
      <div class="headerActions" aria-label="Contact options">
        <a class="headerIcon" href="mailto:enquiries@internationalbodyguards.net" aria-label="Email enquiries at International Bodyguards" title="Email">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3.5 6.5h17v11h-17z"></path><path d="m4.5 7.5 7.5 6 7.5-6"></path></svg>
        </a>
        <a class="headerIcon headerIconWhatsApp" href="https://wa.me/447702298687" target="_blank" rel="noreferrer" aria-label="Contact International Bodyguards on WhatsApp" title="WhatsApp">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.2 11.8a8.2 8.2 0 0 1-12 7.2l-4.5 1.2 1.2-4.4a8.2 8.2 0 1 1 15.3-4Z"></path><path d="M8.2 7.7c.3-.3.7-.4 1-.1l1.1 1.7c.2.3.1.7-.1.9l-.6.7c.7 1.5 1.8 2.6 3.3 3.3l.7-.6c.3-.2.6-.3.9-.1l1.7 1.1c.3.2.3.7.1 1-.6.8-1.5 1.2-2.5 1-3.5-.8-6.2-3.5-7-7-.2-1 .2-1.9 1.4-2.9Z"></path></svg>
        </a>
        <a class="headerCta" href="/request-protection/" aria-current="page">Request protection</a>
      </div>
    </header>

    <section class="requestHero">
      <div>
        <p class="eyebrow"><span></span> Confidential request</p>
        <h1>Request protection.</h1>
      </div>
      <div class="requestHeroIntro">
        <p>Complete this short form with the essential assignment details. We will review your request discreetly and contact you to discuss the next step.</p>
        <div class="requestDirectContacts" aria-label="Direct contact options">
          <a href="https://wa.me/447702298687" target="_blank" rel="noreferrer">
            <span>WhatsApp</span>
            <strong>+44 7702 298 687</strong>
          </a>
          <a href="mailto:enquiries@internationalbodyguards.net">
            <span>Email</span>
            <strong>enquiries@internationalbodyguards.net</strong>
          </a>
        </div>
      </div>
    </section>

    <section class="requestFormLayout">
      <aside>
        <p class="eyebrow darkEyebrow"><span></span> What we need</p>
        <ol>
          <li><span>01</span> Country and city</li>
          <li><span>02</span> Dates or duration</li>
          <li><span>03</span> Number of people</li>
          <li><span>04</span> Type of coverage</li>
        </ol>
        <p class="requestSafetyNote">Do not send passport details, exact private addresses or sensitive threat information through this initial form.</p>
      </aside>

      <div>
        <?php if ($sent): ?>
          <div class="formResult formResultSuccess" role="status">
            <strong>Your request has been sent.</strong>
            <p>Thank you. Our team will review the information and contact you using the details provided.</p>
          </div>
        <?php elseif ($error): ?>
          <div class="formResult formResultError" role="alert">
            <strong>We could not send your request.</strong>
            <p>Please check the required information and try again, or email enquiries@internationalbodyguards.net.</p>
          </div>
        <?php endif; ?>

        <form class="enquiryForm shortEnquiryForm" action="/request-protection/send.php" method="post" accept-charset="UTF-8">
          <div class="hpField" aria-hidden="true">
            <label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
          </div>

          <fieldset>
            <legend><span>01</span> Contact details</legend>
            <div class="formGrid">
              <label class="fullWidth"><span>Full name *</span><input type="text" name="fullName" autocomplete="name" maxlength="120" required></label>
              <label><span>Email address *</span><input type="email" name="email" autocomplete="email" maxlength="190" required></label>
              <label><span>Telephone or WhatsApp *</span><input type="tel" name="phone" autocomplete="tel" maxlength="60" required></label>
            </div>
          </fieldset>

          <fieldset>
            <legend><span>02</span> Protection request</legend>
            <div class="formGrid">
              <label><span>Country *</span><input type="text" name="country" autocomplete="country-name" maxlength="100" required></label>
              <label><span>City or general location *</span><input type="text" name="city" maxlength="120" required></label>
              <label class="fullWidth">
                <span>How long do you require protection? *</span>
                <select name="assignmentType" id="assignment-type" required>
                  <option value="" selected disabled>Select one</option>
                  <option>Temporary protection</option><option>One-day assignment</option><option>Year-round or ongoing protection</option><option>International travel protection</option><option>Not sure yet</option>
                </select>
              </label>
              <label data-start-date hidden><span data-start-label>Start date *</span><input type="date" name="startDate"></label>
              <label data-end-date hidden><span>End date *</span><input type="date" name="endDate"></label>
              <label><span>How many people need protection? *</span><input type="number" name="peopleCount" min="1" max="99" value="1" required></label>
              <label>
                <span>Coverage required *</span>
                <select name="coverageType" required>
                  <option value="" selected disabled>Select one</option>
                  <option>Full-time personal or family protection</option><option>24-hour protection</option><option>Travel protection</option><option>Airport transfer or secure transport</option><option>Business meeting or event</option><option>Occasional protection</option><option>Not sure — please recommend</option>
                </select>
              </label>
              <label class="fullWidth">
                <span>Approximately how many bodyguards are required? *</span>
                <select name="bodyguardCount" required>
                  <option value="" selected disabled>Select one</option>
                  <option>1 bodyguard</option><option>2 bodyguards</option><option>3 bodyguards</option><option>4 bodyguards</option><option>5 or more bodyguards</option><option>Not sure — please recommend</option>
                </select>
              </label>
              <label class="fullWidth">
                <span>Briefly describe what you need</span>
                <textarea name="details" rows="5" maxlength="2000" placeholder="Please do not include passport numbers, exact home addresses or detailed threat information."></textarea>
              </label>
            </div>
          </fieldset>

          <label class="confirmationChoice shortConfirmation">
            <input type="checkbox" name="consent" value="Yes" required>
            <span>I agree to be contacted about this request and understand that services remain subject to assessment, availability and local licensing requirements.</span>
          </label>

          <button type="submit" class="formSubmitButton shortSubmitButton">Send protection request <span aria-hidden="true">↗</span></button>
          <p class="formDeliveryNote">Your request is sent directly to our team. This form will not open Outlook or another email application.</p>
        </form>
      </div>
    </section>

    <footer class="legalFooter">
      <span>© 2026 International Bodyguards</span>
      <a href="/legal/">Legal &amp; licensing notice</a>
      <span>internationalbodyguards.net</span>
    </footer>
  </main>
</body>
</html>

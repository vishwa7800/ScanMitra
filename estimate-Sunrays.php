<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sunrays Queue Estimate</title>
  <style>
    /* ========================
       GLOBAL STYLES
    ======================== */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* modern font */
      color: #fff;
      margin: 0;
      min-height: 100vh;
      background: #000;          /* fallback black background */
      overflow-x: hidden;
      padding: 40px;             /* some space around container */
    }

    /* ========================
       BACKGROUND VIDEO
       - covers whole page
       - darkened with brightness filter
    ======================== */
    .video-background {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
      object-fit: cover;        /* crop video correctly */
      filter: brightness(50%);  /* darken video for text readability */
      z-index: -1;              /* send video behind content */
    }

    /* ========================
       GLASS CARD CONTAINER
       - transparent background
       - blurred backdrop
       - centered on page
    ======================== */
    .container {
      background: rgba(255, 255, 255, 0.15); /* glass effect */
      max-width: 600px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.4);
      backdrop-filter: blur(8px);            /* blur behind card */
      animation: fadeIn 1s ease-in-out;
      text-align: center;
    }

    /* ========================
       HEADINGS & TEXT
    ======================== */
    h2 {
      margin-bottom: 20px;
      color: #fff;
      text-shadow: 0 1px 4px rgba(0,0,0,0.6); /* glow effect */
    }

    p {
      font-size: 16px;
      margin: 8px 0;
      color: #f1f1f1;
      text-shadow: 0 1px 3px rgba(0,0,0,0.6);
    }

    /* highlight numbers/values */
    .highlight {
      font-weight: bold;
      color: #ffd700; /* gold */
      text-shadow: 0 1px 2px rgba(0,0,0,0.6);
    }

    /* ========================
       FAST TRACK BOX
       - golden style for premium option
    ======================== */
    .fast-track {
      margin: 20px 0;
      padding: 14px;
      background: rgba(255, 193, 7, 0.15);  /* transparent golden */
      border: 1px solid #ffc107;            /* golden border */
      border-radius: 6px;
      font-size: 15px;
      color: #ffda6a;
      text-align: center;
      font-weight: 600;
    }
    .fast-track .highlight {
      color: #ffae00; /* deeper orange highlight */
    }

    /* ========================
       FORM STYLING
       - styled inputs & dropdown
       - smooth button
    ======================== */
    form {
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      gap: 15px;
      text-align: left;
    }

    label {
      font-weight: bold;
      text-shadow: 0 1px 3px rgba(0,0,0,0.6);
    }

    input[type="text"], select {
      padding: 10px;
      border: 1px solid rgba(255,255,255,0.5);
      border-radius: 6px;
      width: 100%;
      background: rgba(255,255,255,0.2); /* semi-transparent background */
      color: #fff;                        /* text color inside input */
      caret-color: #fff;                  /* white typing cursor */
    }

    input::placeholder, select::placeholder {
      color: rgba(255,255,255,0.7);
    }

    /* custom dropdown arrow for select */
    select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background: rgba(255,255,255,0.2) 
        url('data:image/svg+xml;utf8,<svg fill="white" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>') 
        no-repeat right 10px center;
      background-size: 1em;
      padding-right: 35px; /* space for arrow */
    }

/* dropdown options styling  */
    select option {
      background: #fff;   /* white background */
      color: #000;        /* black text */
    }

    /* styled button */
    button {
      background-color: rgba(85, 99, 222, 0.8); /* bluish button */
      color: #fff;
      border: none;
      padding: 12px 20px;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
      font-size: 16px;
    }
    button:hover {
      background-color: rgba(68, 82, 184, 0.8);
      transform: scale(1.05);
    }

    /* ========================
       SIMPLE FADE-IN ANIMATION
    ======================== */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <!-- ===== Background Video ===== -->
  <video autoplay muted loop class="video-background">
    <source src="shopVd.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>

  <!-- ===== Main Card Content ===== -->
  <div class="container">
    <h2>Sunrays Queue Estimate</h2>

    <!-- Queue Information (updated for diagnostic center) -->
    <p><strong>People ahead of you:</strong> <span class="highlight">3</span></p>
    <p><strong>Your estimated wait:</strong> <span class="highlight">~60 mins</span> <span style="font-size:14px;color:#ffd700;">(based on services booked ahead)</span></p>
    <p><strong>Slots left today:</strong> <span class="highlight">2</span></p>

    <!-- Fast-Track Offer -->
    <div class="fast-track">
      <p>✨ <strong>Optional Fast-Track Service</strong></p>
      <p>Pay extra <span class="highlight">₹250</span> → Get slot in <span class="highlight">10 mins</span></p>
    </div>

    <!-- Booking Form -->
    <form method="POST" action="booknow.php">
      <label>Your Phone Number:</label>
      <input type="text" name="phone" placeholder="Enter phone number" required>

      <label>Service:</label>
      <select name="service">
        <option value="Ultrasound">Ultrasound – ₹800 (15–30 mins)</option>
        <option value="X-Ray">X-ray – ₹500 (10–15 mins)</option>
        <option value="MRI">MRI – ₹3500 (20–45 mins)</option>
        <option value="Bloodtest">Blood Test – ₹300 (5–10 mins)</option>
      </select>

      <button type="submit">Book Now</button>
    </form>
  </div>

</body>
</html>

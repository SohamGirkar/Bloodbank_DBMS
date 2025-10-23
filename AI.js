document.addEventListener("DOMContentLoaded", function () {
  const chatMessages = document.getElementById("chatMessages");
  const userInput = document.getElementById("userInput");
  const sendButton = document.getElementById("sendButton");
  const typingIndicator = document.getElementById("typingIndicator");
  const suggestedQuestionsContainer =
    document.getElementById("suggestedQuestions");
  const toggleSuggestionsBtn = document.getElementById("toggleSuggestions");
  const homeBtn = document.getElementById("homeBtn");
  const backBtn = document.getElementById("backBtn");
  const moreBtn = document.getElementById("moreBtn");

  let conversationHistory = [];
  let suggestionHistory = ["main"];
  let suggestionsEnabled = true;
  let emailTemplateRequested = false;

  const knowledgeBase = {
    // Greeting responses
    hi: "Hello! How can I help you today?",
    fine: "Great! How can I help you today?",
    good: "Great! How can I help you today?",
    hello: "Hello! How can I help you today?",
    hey: "Hi there! What's on your mind?",
    "good morning": "Good morning! I hope your day is going well.",
    "good afternoon": "Good afternoon! How can I assist you?",
    "good evening": "Good evening! What would you like to do today?",
    "good night": "Good night! Sleep well, talk to you soon.",
    "how are you": "I'm doing great, thank you! How about you?",
    "how's it going": "I'm here and ready to help! How are you?",
    "how are you doing":
      "I'm good, thanks for asking. What can I do for you today?",
    yo: "Hey! Not much, just here to help you.",
    "what's up": "Yo! What's up with you?",
    "hey buddy": "Hey buddy! How's it going?",
    greetings: "Greetings! How may I assist you today?",
    "good day": "Good day! How can I help you?",
    "nice to meet you": "It's nice to meet you too! What brings you here?",
    "long time no see": "It's nice to chat with you again!",
    "glad to see you": "I'm glad to see you too. What's new?",
    "missed you": "I missed our chats! How have you been?",
    namaste: "Namaste! How can I help you today?",
    "assalamu alaikum": "Wa Alaikum Assalam! What would you like to do?",
    hola: "Hola! ¿Cómo estás?",
    bonjour: "Bonjour! Comment puis-je vous aider?",
    "hello ai": "Yes, I'm here! How can I assist you?",
    "hi bot": "Hello! I'm your AI assistant, ready to help.",
    "hey assistant": "Hi there! I'm online and ready when you are.",
    "is anyone there": "Yes, I'm here! How can I help you today?",
    "knock knock": "Who's there? 😄",
    "yoo-hoo": "Yoo-hoo! I see you!",
    "guess who": "I'll guess… it's you! Welcome back.",
    he: "Hi there! Did you mean 'hello'?",
    hlo: "Hello! I got your greeting loud and clear.",
    helloo: "Hey! I'm here, how can I help?",
    hiii: "Hi there! How can I assist you today?",
    "what can you do":
      "I can answer questions about blood donation, eligibility requirements, the donation process, blood types, and more. Just ask me anything!",
    "what are your features":
      "I can help you understand blood donation requirements, find donation centers, answer health-related questions, and provide information about different blood types and their importance.",
    help: "I'm here to help! You can ask me about: • Eligibility requirements • Donation process • Health and safety • Blood types • Finding donation centers • And much more!",
    "thank you":
      "You're welcome! Is there anything else you'd like to know about blood donation?",
    thanks: "Happy to help! Let me know if you have any other questions.",
    "you're awesome":
      "Thank you! I'm here to make blood donation information accessible to everyone.",
    "i love you":
      "I'm here to help with blood donation information! Let me know how I can assist you today.",

    // Eligibility questions (1-75)
    "What are the basic requirements to donate blood?":
      "You must be healthy, at least 17 years old (16 with parental consent in some places), and weight at least 50 kg (110 lbs).",
    "Is there a minimum age for blood donation?":
      "Yes, usually 17 years, though some regions allow 16 with parental consent.",
    "What is the maximum age for donating blood?":
      "There is generally no strict upper age limit as long as you are healthy, but some centers may set their own cutoffs (65–70 years).",
    "Can 16-year-olds donate blood?":
      "Yes, in some countries with parental consent; otherwise, the minimum is 17.",
    "Can 70-year-olds donate blood?":
      "Yes, if they are in good health and pass screening, but some centers set an upper limit.",
    "Is there a weight requirement for blood donation?":
      "Yes, typically at least 50 kg (110 lbs).",
    "What if I'm slightly underweight?":
      "You may be deferred from donating for safety reasons.",
    "Can I donate if I'm overweight?":
      "Yes, as long as you meet health and screening requirements.",
    "Can people with diabetes donate blood?":
      "Yes, if their condition is well-controlled and they are otherwise healthy.",
    "Can Type 1 diabetics donate blood?":
      "Yes, if controlled and no complications are present.",
    "Can Type 2 diabetics donate blood?":
      "Yes, if managed with diet or medication and no complications exist.",
    "Can I donate if I'm on insulin?":
      "Yes, if your diabetes is well-controlled and you're otherwise healthy.",
    "Can I donate with high blood pressure?":
      "Yes, if it is under control and within acceptable limits at the time of donation.",
    "What BP is too high for donation?":
      "Generally, a reading above 180/100 mmHg is too high.",
    "Can I donate if I have low blood pressure?":
      "Yes, if you feel well and are not experiencing symptoms like fainting.",
    "Can I donate if I have high cholesterol?":
      "Yes, high cholesterol is not a restriction.",
    "Can I donate if I'm on cholesterol medication?":
      "Yes, it is safe to donate.",
    "Can I donate if I have heart disease?":
      "Usually no, as it may pose health risks.",
    "Can I donate if I've had a heart attack?":
      "No, a history of heart attack usually disqualifies you.",
    "Can I donate if I've had heart surgery?":
      "Typically no, especially if you have ongoing cardiac issues.",
    "Can I donate if I have a pacemaker?":
      "No, donors with pacemakers are generally deferred.",
    "Can I donate if I'm anemic?":
      "No, low hemoglobin or anemia prevents donation.",
    "How is anemia tested before donation?":
      "Through a simple finger prick hemoglobin test.",
    "What hemoglobin level is required?":
      "At least 12.5 g/dL for women and 13.0 g/dL for men.",
    "Can I donate if I'm taking iron supplements?":
      "Yes, as long as your hemoglobin level meets the requirement.",
    "Can I donate if I'm on birth control pills?": "Yes, it is safe to donate.",
    "Can I donate if I have an IUD?": "Yes, it is safe to donate.",
    "Can I donate if I'm using hormone therapy?":
      "Yes, in most cases, unless related to cancer treatment.",
    "Can I donate if I'm pregnant?": "No, pregnant women cannot donate.",
    "How long after pregnancy can I donate?":
      "Usually 6 weeks after delivery, if fully recovered.",
    "Can I donate if I'm breastfeeding?":
      "No, breastfeeding mothers are deferred until 6 months postpartum.",
    "Can I donate if I'm menstruating?":
      "Yes, if you feel well and hemoglobin is sufficient.",
    "Can I donate if I have heavy periods?":
      "Yes, but you may be deferred if your hemoglobin is low.",
    "Can I donate if I've had a miscarriage?":
      "Yes, usually after a 6-week recovery period.",
    "Can I donate if I've had an abortion?": "Yes, after at least 6 weeks.",
    "Can I donate if I've recently had surgery?":
      "Yes, after full recovery and healing, depending on type of surgery.",
    "How long after surgery must I wait?":
      "Typically 3–6 months, depending on surgery and recovery.",
    "Can I donate if I have tattoos?":
      "You can donate blood if you have tattoos, but there is typically a waiting period of 3-6 months after getting a new tattoo, depending on state regulations and whether it was done in a licensed facility.",
    "How long after getting a tattoo can I donate?":
      "Usually 3–6 months, depending on local rules.",
    "Can I donate if I have piercings?": "Yes, after a short waiting period.",
    "How long after piercing can I donate?": "Typically 3–6 months.",
    "Can I donate if I've had acupuncture?":
      "Yes, if performed with sterile, single-use needles.",
    "Can I donate if I've had electrolysis?": "Yes, usually no restrictions.",
    "Can I donate if I've recently traveled?":
      "Yes, unless you visited areas with certain diseases.",
    "Which countries have travel restrictions?":
      "Areas with malaria, Zika, or variant Creutzfeldt-Jakob disease (vCJD) risk.",
    "How long after international travel can I donate?":
      "From 4 weeks to 3 years, depending on the risk region.",
    "Can I donate if I've been to malaria-risk areas?":
      "You must wait 12 months.",
    "Can I donate if I've had malaria?": "No, usually not eligible.",
    "Can I donate if I've had Zika virus?": "Yes, after 4 weeks from recovery.",
    "Can I donate if I've had dengue fever?":
      "Yes, after 4 weeks from recovery.",
    "Can I donate if I've had COVID-19?": "Yes, after full recovery.",
    "How long after COVID-19 can I donate?":
      "At least 14–28 days after recovery.",
    "Can I donate after COVID vaccination?": "Yes, if you feel well.",
    "How long after vaccination must I wait?":
      "Usually no wait for inactivated vaccines; 14 days for live vaccines.",
    "Can I donate if I have allergies?": "Yes, unless symptoms are severe.",
    "Can I donate during allergy season?": "Yes, if you are well at the time.",
    "Can I donate if I have asthma?":
      "Yes, if controlled and no recent attacks.",
    "Can I donate if I use an inhaler?": "Yes, if asthma is controlled.",
    "Can I donate if I have eczema?":
      "Yes, if the skin is intact at the needle site.",
    "Can I donate if I have psoriasis?":
      "Yes, unless it affects the donation area.",
    "Can I donate if I have arthritis?": "Yes, if you are otherwise healthy.",
    "Can I donate if I have fibromyalgia?": "Yes, if you feel well.",
    "Can I donate if I have epilepsy?":
      "Yes, if controlled and seizure-free for at least 1 year.",
    "Can I donate if I have migraines?":
      "Yes, unless experiencing a severe attack.",
    "Can I donate if I'm on medication for mental health?":
      "Yes, most antidepressants and antianxiety medications are acceptable.",
    "Can I donate if I have depression?": "Yes, if stable and under treatment.",
    "Can I donate if I have anxiety?":
      "Yes, if stable and not having an attack.",
    "Can I donate if I have ADHD?": "Yes, ADHD itself is not a restriction.",
    "Can I donate if I have autism?": "Yes, if you meet other health criteria.",
    "Can I donate if I have a history of cancer?":
      "It depends on type and treatment.",
    "What types of cancer prevent donation?":
      "Blood cancers like leukemia, lymphoma, or myeloma.",
    "How long after cancer treatment can I donate?":
      "At least 5 years cancer-free, depending on type.",
    "Can I donate if I have a family history of cancer?":
      "Yes, family history does not prevent donation.",
    "Can I donate if I have a genetic disorder?":
      "It depends on the disorder; some allow donation, some don't.",
    "Can I donate if I have hemochromatosis?":
      "Yes, in many places, but only at approved donation centers.",

    // Donation Process (76-150)
    "What should I do to prepare for donation?":
      "Eat a healthy meal, drink plenty of water, and get good rest.",
    "Should I eat before donating blood?":
      "Yes, eating a light, balanced meal helps prevent dizziness.",
    "What foods are best before donation?":
      "Iron-rich foods (spinach, red meat, beans) and vitamin C-rich foods (citrus, tomatoes).",
    "Should I avoid certain foods before donating?":
      "Yes, avoid fatty or greasy foods, as they affect blood testing.",
    "How much water should I drink before donating?":
      "At least 2–3 glasses (about 500–750 ml) of water.",
    "Can I drink coffee before donating?":
      "Yes, but don't overdo it—too much caffeine can dehydrate you.",
    "Can I drink alcohol before donating?":
      "No, avoid alcohol for at least 24 hours before donating.",
    "Should I avoid smoking before donation?":
      "Yes, avoid smoking at least 1–2 hours before donating.",
    "Should I get a good night's sleep before donating?":
      "Yes, 7–8 hours of rest is recommended.",
    "What should I wear to donate blood?":
      "Comfortable clothing with sleeves that can be rolled up.",
    "What documents do I need to bring?":
      "A valid photo ID (driver's license, passport, national ID).",
    "Do I need to know my blood type to donate?":
      "No, it will be tested after donation.",
    "How long does the entire process take?": "Around 45 minutes to 1 hour.",
    "What happens when I first arrive?":
      "You'll register, show ID, and fill out a health questionnaire.",
    "What questions will I be asked?":
      "Health history, medications, travel, and lifestyle habits.",
    "Why are so many questions asked?":
      "To ensure your safety and protect recipients.",
    "What is the health screening process?":
      "Includes checking temperature, blood pressure, pulse, and hemoglobin.",
    "Will my blood pressure be checked?": "Yes, before donation.",
    "Will my temperature be taken?": "Yes, to check for fever or infection.",
    "How is hemoglobin tested?": "By a quick finger prick blood sample.",
    "What does the finger prick test for?":
      "It checks your hemoglobin/iron levels.",
    "How is the donation area prepared?":
      "Your arm is cleaned with antiseptic.",
    "How is the needle inserted?":
      "A trained staff member gently inserts a sterile needle into a vein.",
    "What size needle is used?":
      "Typically 16- or 17-gauge for whole blood donation.",
    "Does the needle hurt?": "Only a brief sting, then minimal discomfort.",
    "What should I do during donation?":
      "Relax, squeeze the stress ball, and breathe normally.",
    "Can I listen to music during donation?": "Yes, many centers encourage it.",
    "Can I use my phone during donation?":
      "Yes, if it doesn't interfere with the procedure.",
    "How long does the actual donation take?":
      "Around 8–10 minutes for whole blood.",
    "How much blood is taken?": "About 1 pint (450–500 ml).",
    "What is a unit of blood?": "One unit = about 450–500 ml.",
    "What happens if I feel faint during donation?":
      "Staff will lower your chair, give fluids, and help you recover.",
    "What happens if I feel pain during donation?":
      "Alert staff immediately; the needle may be adjusted.",
    "Can the staff stop the donation if needed?":
      "Yes, they can stop anytime if you're unwell.",
    "What is apheresis donation?":
      "A process where only specific components (plasma, platelets, etc.) are collected.",
    "How is platelet donation different?":
      "It uses apheresis to collect only platelets, returning other components to you.",
    "How is plasma donation different?":
      "Plasma is separated and collected through apheresis.",
    "How is double red cell donation different?":
      "Two units of red cells are collected, and plasma/platelets returned.",
    "Which type of donation takes the longest?":
      "Platelet donation (90–120 minutes).",
    "Which donation type is most needed?":
      "It depends, but platelets and O-negative whole blood are often in high demand.",
    "Can I choose which type of donation to make?":
      "Yes, based on your eligibility and center's needs.",
    "What equipment is used during donation?":
      "A sterile needle, blood bag, and monitoring equipment.",
    "How is the blood collected?":
      "It flows into a sterile blood bag through tubing.",
    "How is the blood stored during donation?":
      "Collected in bags with anticoagulants, kept at controlled temperatures.",
    "What happens when the donation is complete?":
      "The needle is removed, and a bandage is applied.",
    "What are the eligibility requirements for blood donation?":
      "To donate blood, a person must generally be in good health, at least 17 years old (16 with parental consent in some places), and weigh a minimum of around 50 kg (110 lbs). Donors should not have recent infections, chronic illnesses, or certain medical conditions that could affect blood safety. They must avoid high-risk behaviors, recent tattoos or piercings, and certain medications that can temporarily defer donation. Additionally, there are specific guidelines regarding pregnancy, recent surgeries, and travel to regions with infectious disease risks. Blood pressure, hemoglobin levels, and overall health are usually checked before donation to ensure both donor safety and the safety of the blood supply.",
    "What should I do after the needle is removed?":
      "Apply firm pressure and keep arm raised briefly.",
    "How long should I keep pressure on the site?": "For at least 2–5 minutes.",
    "How long should I keep the bandage on?": "At least 4–6 hours.",
    "What refreshments are offered after donation?":
      "Juice, water, and light snacks.",
    "Why are refreshments important?":
      "They help replace fluids and stabilize blood sugar.",
    "How long should I rest after donation?":
      "At least 10–15 minutes at the center.",
    "Can I drive myself home after donation?": "Yes, if you feel well.",
    "When can I resume normal activities?":
      "Most activities can resume immediately, but avoid heavy lifting.",
    "What is the recovery process like?":
      "You may feel normal quickly, but hydration and nutrition help.",
    "What is a power red donation?":
      "Another term for double red cell donation.",
    "How often can I donate whole blood?": "Every 8 weeks (56 days).",
    "How often can I donate platelets?":
      "Every 7 days, up to 24 times per year.",
    "How often can I donate plasma?": "Every 28 days.",
    "How often can I donate double red cells?": "Every 16 weeks (112 days).",
    "Why are there different intervals between donations?":
      "To allow your body to fully recover.",
    "What is autologous donation?":
      "Donating blood for your own planned surgery.",
    "What is directed donation?": "Donating specifically for a chosen patient.",
    "Can I donate for a specific person?":
      "Yes, through directed donation programs.",
    "What is a blood drive?":
      "An organized event to collect blood from multiple donors.",
    "How are mobile blood drives different?":
      "They are temporary donation sites set up at schools, offices, or communities.",
    "Can I donate at different locations?":
      "Yes, any approved donation center or drive.",
    "How do I find donation centers?":
      "Through online searches, apps, or local blood banks.",
    "How do I schedule an appointment?":
      "By phone, website, or donation center app.",
    "Can I walk in without an appointment?":
      "Yes, but appointments are preferred.",
    "What if I need to cancel my appointment?":
      "Call or cancel online as soon as possible.",
    "Can I reschedule my donation?": "Yes, via the website, app, or phone.",
    "Is there a waiting list for donations?":
      "Some centers may keep a list for urgent needs.",
    "Are there peak times for donation?":
      "Yes, weekends and after work hours are busiest.",
    "What is the busiest time at donation centers?":
      "Late afternoons, evenings, and during holiday shortages.",

    // Health & Safety (151-225)
    "How safe is blood donation?":
      "Very safe—donation is performed by trained staff with sterile, single-use equipment.",
    "What safety protocols are in place?":
      "Donor screening, sterile needles, infection control, and post-donation monitoring.",
    "Are needles sterile?": "Yes, every needle is brand new and sterile.",
    "Are needles reused?": "No, needles are never reused.",
    "How are needles disposed of?":
      "They are placed in medical sharps containers and destroyed.",
    "What prevents needle stick injuries?":
      "Proper training, safety devices, and careful technique.",
    "What infection control measures are used?":
      "Hand hygiene, gloves, antiseptic skin prep, and sterile tools.",
    "How is the donation area cleaned?":
      "Surfaces are disinfected between donors.",
    "What are the risks of blood donation?":
      "Minor bruising, dizziness, or fainting. Serious risks are very rare.",
    "How common are adverse reactions?": "Less than 2% of donations.",
    "What are the most common side effects?":
      "Dizziness, lightheadedness, bruising, or fatigue.",
    "What is vasovagal reaction?":
      "A fainting episode caused by anxiety, pain, or seeing blood.",
    "How is fainting prevented?":
      "Hydration, snacks, and relaxation techniques.",
    "What happens if I faint during donation?":
      "Staff will stop the donation, lower your head, and give fluids.",
    "What happens if I feel dizzy after donation?":
      "Sit or lie down, drink water, and rest.",
    "What is bruising at the needle site?":
      "It's blood leaking under the skin, causing discoloration.",
    "How can bruising be minimized?":
      "Apply pressure and keep the bandage on for several hours.",
    "What is a hematoma?":
      "A larger bruise caused by blood pooling under the skin.",
    "How is a hematoma treated?":
      "Cold compresses for 24 hours, then warm compresses.",
    "What is nerve irritation?":
      "Tingling or shooting pain if the needle brushes a nerve.",
    "How common is nerve damage?": "Extremely rare.",
    "What is arterial puncture?":
      "Accidentally hitting an artery instead of a vein.",
    "How is arterial puncture treated?":
      "Immediate pressure, stopping donation, and monitoring.",
    "What are the signs of infection?":
      "Redness, swelling, warmth, pus, or fever.",
    "How is infection prevented?": "Sterile technique and antiseptic cleaning.",
    "Can I get AIDS from donating blood?":
      "No, there is zero risk—needles are never reused.",
    "Can I get hepatitis from donating blood?":
      "No, the process is completely safe.",
    "How is cross-contamination prevented?":
      "By using single-use, sealed, sterile equipment.",
    "What tests are performed on donated blood?":
      "HIV, hepatitis B & C, syphilis, HTLV, malaria (in some regions).",
    "How is blood screened for diseases?":
      "Through advanced lab tests on every donation.",
    "What diseases are tested for?":
      "HIV, hepatitis B & C, syphilis, HTLV, and sometimes Zika, malaria, West Nile.",
    "How accurate are blood tests?":
      "Very accurate, using modern sensitive methods.",
    "What happens if my blood tests positive?": "It is discarded and not used.",
    "Will I be notified if my blood is rejected?":
      "Yes, confidentially by the blood center.",
    "How is confidentiality maintained?":
      "Personal information and test results are strictly protected.",
    "Can I find out my test results?":
      "Yes, the center will contact you if any issues are found.",
    "How long does it take to get test results?": "Usually within 7–14 days.",
    "What if I have a medical condition I didn't know about?":
      "You'll be notified confidentially if detected in your blood tests.",
    "Can donation affect my health negatively?":
      "No, most people recover quickly. Rarely, minor side effects occur.",
    "Does donation weaken my immune system?":
      "No, your immune system stays strong.",
    "Does donation affect my energy levels?":
      "You may feel slightly tired but should recover quickly.",
    "Can donation cause iron deficiency?":
      "Yes, frequent donations can lower iron levels.",
    "How is iron deficiency prevented?":
      "Eat iron-rich foods and donate only at recommended intervals.",
    "Should I take iron supplements?":
      "Sometimes, especially if you donate often—consult a doctor first.",
    "What foods help rebuild iron stores?":
      "Red meat, beans, spinach, fortified cereals, and citrus (for absorption).",
    "How long until my blood volume returns to normal?":
      "Plasma replaces within 24–48 hours.",
    "How long until my red blood cells regenerate?": "About 6–8 weeks.",
    "Can I donate if I'm feeling unwell?":
      "No, you should wait until fully recovered.",
    "What symptoms should prevent donation?":
      "Fever, cough, sore throat, or general weakness.",
    "Can I donate with a cold?": "No, wait until symptoms are gone.",
    "Can I donate with a fever?": "No, you must be fever-free.",
    "Can I donate with a cough?": "No, especially if caused by infection.",
    "Can I donate with a sore throat?": "No, wait until you recover.",
    "Can I donate with diarrhea?": "No, wait until fully recovered.",
    "Can I donate if I've been vomiting?": "No, wait until fully recovered.",
    "Can I donate if I have a UTI?":
      "No, wait until treatment is finished and you're symptom-free.",
    "Can I donate if I have a sinus infection?":
      "No, wait until fully recovered.",
    "Can I donate if I have an ear infection?":
      "No, wait until infection clears.",
    "Can I donate if I have a skin infection?": "No, wait until healed.",
    "Can I donate if I have a fungal infection?":
      "Yes, if mild and not at the needle site.",
    "Can I donate if I have herpes?":
      "Yes, if you're not having an active outbreak at the donation site.",
    "Can I donate if I have cold sores?":
      "Yes, unless sores are active near the needle area.",
    "Can I donate if I have HPV?": "Yes, HPV is not a restriction.",
    "Can I donate if I have HIV/AIDS?":
      "No, HIV-positive individuals cannot donate.",
    "Can I donate if I have hepatitis B?":
      "No, hepatitis B is a permanent deferral.",
    "Can I donate if I have hepatitis C?":
      "No, hepatitis C is a permanent deferral.",
    "Can I donate if I have syphilis?":
      "No, you must wait until fully treated and cleared.",
    "Can I donate if I have TB?":
      "No, you must wait until treatment is complete and you're cleared.",
    "Can I donate if I have Lyme disease?":
      "Yes, after treatment and full recovery.",
    "Can I donate if I have West Nile virus?":
      "Yes, after at least 120 days symptom-free.",
    "Can I donate if I have Creutzfeldt-Jakob disease?":
      "No, you cannot donate.",
    "Can I donate if I have vCJD?": "No, permanently deferred.",
    "Can I donate if I have Ebola?": "No, permanent deferral.",
    "Can I donate if I've been exposed to infectious diseases?":
      "You may need to wait depending on exposure and risk.",
    "Can I donate if I work in healthcare?":
      "Yes, as long as you're healthy and meet criteria.",

    // After Donation (226-275)
    "What should I do immediately after donation?":
      "Rest for 10–15 minutes, drink fluids, and have a snack.",
    "How long should I rest after donation?":
      "At least 10–15 minutes at the donation site.",
    "Should I avoid certain activities after donation?":
      "Yes, avoid heavy lifting, strenuous exercise, and smoking for a few hours.",
    "When can I exercise after donation?":
      "Light exercise the next day; avoid strenuous activity for 24 hours.",
    "What types of exercise should I avoid?":
      "Heavy lifting, high-intensity workouts, or contact sports on the same day.",
    "When can I lift weights after donation?":
      "After 24 hours, if you feel well.",
    "When can I run after donation?": "Wait at least 24 hours before running.",
    "When can I swim after donation?":
      "The next day, once the needle site has healed.",
    "Can I take a shower after donation?":
      "Yes, but avoid hot showers immediately after.",
    "When can I remove the bandage?": "After 4–6 hours.",
    "What should I do if bleeding continues?":
      "Apply firm pressure and raise your arm for 5–10 minutes.",
    "What should I do if I notice bruising?":
      "Apply a cold compress for the first 24 hours.",
    "How can I reduce bruising?":
      "Keep pressure on the site and avoid heavy use of that arm.",
    "What should I do if I feel dizzy?":
      "Lie down, elevate your legs, and drink water.",
    "What should I do if I feel nauseous?":
      "Rest, breathe slowly, and sip fluids.",
    "What should I do if I faint after donation?":
      "Lie flat, elevate legs, and seek help if it persists.",
    "When should I seek medical attention?":
      "If bleeding won't stop, severe pain occurs, or signs of infection appear.",
    "What should I eat after donation?":
      "Iron-rich foods (meat, beans, spinach) and vitamin C-rich foods.",
    "What foods help recovery?":
      "Lean meats, leafy greens, citrus fruits, and fortified cereals.",
    "How much should I drink after donation?":
      "At least 2–3 extra glasses of water within 24 hours.",
    "What fluids are best after donation?":
      "Water, juice, and electrolyte drinks.",
    "Should I avoid alcohol after donation?":
      "Yes, avoid alcohol for 24 hours.",
    "How long should I avoid alcohol?": "At least 24 hours after donation.",
    "Should I avoid caffeine after donation?":
      "Limit caffeine, as it can dehydrate you.",
    "Can I smoke after donation?": "Avoid smoking for at least 2 hours.",
    "How does smoking affect recovery?":
      "It reduces oxygen levels and may delay recovery.",
    "When can I drive after donation?":
      "You can drive if you feel well and not dizzy.",
    "Should I avoid long drives after donation?":
      "Yes, if you feel tired or lightheaded.",
    "Can I go back to work after donation?":
      "Yes, if your work is not physically demanding.",
    "What if my job involves physical labor?":
      "Rest longer before resuming heavy tasks.",
    "What if my job involves operating machinery?":
      "Wait until you feel fully alert and stable.",
    "When will my energy levels return to normal?": "Usually within 24 hours.",
    "How can I boost my energy after donation?":
      "Eat balanced meals, stay hydrated, and rest well.",
    "Should I take iron supplements after donation?":
      "Only if recommended by a doctor.",
    "How long should I take iron supplements?":
      "Typically for a few weeks, if advised by your doctor.",
    "What are the signs of iron deficiency?":
      "Fatigue, pale skin, dizziness, or shortness of breath.",
    "How long until my iron levels recover?":
      "4–8 weeks, depending on diet and body needs.",
    "How long until I can donate again?":
      "Whole blood: 8 weeks; platelets: 7 days; plasma: 28 days.",
    "Why must I wait between donations?":
      "To allow your body to replenish blood cells and iron.",
    "What if I want to donate more frequently?":
      "You must follow the minimum safe intervals.",
    "How will I be notified about my blood?":
      "Some centers send text or email updates.",
    "What if my blood is used for a patient?":
      "You may get an anonymous notification, but not patient details.",
    "Can I find out who received my blood?":
      "No, recipient information is confidential.",
    "Can I receive updates on my donation?":
      "Yes, many centers provide donor updates.",
    "How is my personal information protected?":
      "Strict privacy laws and secure databases are used.",
    "What if I have concerns after donation?":
      "Contact the donation center or doctor.",
    "Who should I contact with questions?":
      "Your local blood bank or donor center.",
    "What if I experience delayed symptoms?":
      "Seek medical advice and report to the donation center.",
    "Are there long-term effects of donation?":
      "No, regular donors remain healthy with proper nutrition.",
    "How does regular donation affect health?":
      "It may reduce iron overload, support cardiovascular health, and gives a sense of well-being.",

    // Blood Types & Compatibility (276-325)
    "What are the different blood types?":
      "A, B, AB, and O, each of which can be Rh-positive (+) or Rh-negative (–).",
    "How is blood type determined?":
      "By the presence or absence of A and B antigens on red blood cells and the Rh factor.",
    "What is the ABO system?":
      "It classifies blood as A, B, AB, or O based on surface antigens.",
    "What is the Rh factor?":
      "A protein that can be present (+) or absent (–) on red blood cells.",
    "What does positive and negative mean?":
      "It refers to whether the Rh antigen is present (+) or absent (–).",
    "What is the most common blood type?":
      "O-positive is the most common worldwide.",
    "What is the rarest blood type?":
      "AB-negative is the rarest common type; Rh-null ('golden blood') is extremely rare.",
    "What blood type is universal donor?": "O-negative for red cells.",
    "What blood type is universal recipient?": "AB-positive for red cells.",
    "Why is O-negative so important?":
      "It can be given to anyone in emergencies when type is unknown.",
    "Why is AB-positive special?":
      "AB-positive can receive blood from any type.",
    "Can blood types change?": "No, your blood type stays the same for life.",
    "How is blood type inherited?":
      "From your parents' genes (one from each parent).",
    "Can parents with certain blood types have children with different types?":
      "Yes, depending on gene combinations.",
    "What are the percentages of each blood type?":
      "O-positive: ~38%, O-negative: ~7%, A-positive: ~34%, A-negative: ~6%, B-positive: ~9%, B-negative: ~2%, AB-positive: ~3%, AB-negative: ~1%.",
    "Do blood type distributions vary by ethnicity?":
      "Yes, frequencies differ across ethnic groups and regions.",
    "What blood types are most needed?":
      "O-negative and O-positive are most in demand.",
    "Why are some blood types often in short supply?":
      "Because demand is high and fewer donors have them.",
    "How does blood type affect donation?":
      "It determines who can safely receive your blood.",
    "Can I donate to someone with a different blood type?":
      "Only if compatible based on ABO and Rh rules.",
    "Who can receive O-negative blood?":
      "Anyone, especially critical patients in emergencies.",
    "Who can receive O-positive blood?":
      "O-positive and other positive types (A+, B+, AB+).",
    "Who can receive A-negative blood?": "A– and AB– recipients.",
    "Who can receive A-positive blood?": "A+ and AB+ recipients.",
    "Who can receive B-negative blood?": "B– and AB– recipients.",
    "Who can receive B-positive blood?": "B+ and AB+ recipients.",
    "Who can receive AB-negative blood?": "AB– recipients.",
    "Who can receive AB-positive blood?":
      "Only AB+ (they are universal recipients).",
    "What is blood type compatibility?":
      "The safe matching of donor and recipient blood.",
    "What happens if incompatible blood is transfused?":
      "A dangerous immune reaction called hemolytic transfusion reaction.",
    "What is hemolytic reaction?":
      "When antibodies destroy incompatible donor red blood cells.",
    "How are compatibility issues prevented?":
      "By blood typing, crossmatching, and strict testing.",
    "What is crossmatching?":
      "Mixing donor and recipient blood in a lab to check compatibility.",
    "How is blood matched for transfusions?":
      "Through ABO/Rh typing and crossmatching.",
    "What are rare blood types?":
      "Types found in less than 1% of the population, like AB– or Bombay group.",
    "What is Bombay blood group?":
      "A very rare type (hh) lacking A, B, and H antigens.",
    "What is Rh null blood?":
      "Extremely rare blood with no Rh antigens, known as 'golden blood'.",
    "How are rare blood donors found?":
      "Through international registries and blood banks.",
    "What is a blood type registry?":
      "A database of donors with rare blood types.",
    "Can I find out my blood type after donation?":
      "Yes, the center can inform you after testing.",
    "How accurate is blood typing?":
      "Highly accurate with modern lab techniques.",
    "What if my blood type is misidentified?":
      "Crossmatching ensures safety even if initial typing was wrong.",
    "Can I request a specific blood type for donation?":
      "You cannot change your type, but you can donate for a matching recipient.",
    "Does blood type affect health?":
      "Mostly no, but some studies suggest links to disease risk.",
    "Are certain blood types linked to diseases?":
      "Some research shows higher risks (e.g., O with ulcers, A with heart disease).",
    "Does blood type affect personality?":
      "No scientific proof, though some cultures believe so.",
    "Does blood type affect diet?":
      "The 'blood type diet' exists, but it's not scientifically proven.",
    "Should I know my blood type for emergency?":
      "Yes, it's useful in emergencies.",
    "How can I learn my blood type?":
      "Through donation, a lab test, or medical records.",
    "Can I get a blood type card?":
      "Yes, many centers provide a donor or blood type card.",

    // Benefits & Impact (326-375)
    "Why is blood donation important?":
      "Because it saves lives by providing blood for surgeries, accidents, cancer treatment, and chronic illnesses.",
    "How does my donation help others?":
      "Your one donation can help up to three patients by separating red cells, plasma, and platelets.",
    "How many people can my donation help?":
      "Up to three people from a single unit of blood.",
    "What are the components of blood?":
      "Red blood cells, white blood cells, platelets, and plasma.",
    "How is blood separated into components?":
      "By centrifuging (spinning) the donated blood in a lab.",
    "What is red blood cell transfusion used for?":
      "To treat anemia, blood loss, and surgical or trauma patients.",
    "What is platelet transfusion used for?":
      "For cancer patients, bone marrow transplants, or bleeding disorders.",
    "What is plasma transfusion used for?":
      "To treat burns, shock, and clotting disorders.",
    "What is cryoprecipitate used for?":
      "For patients with hemophilia, von Willebrand disease, or massive bleeding.",
    "Who needs blood transfusions?":
      "Surgery patients, accident victims, cancer patients, and people with blood disorders.",
    "Do surgery patients need blood?":
      "Yes, especially in major operations with blood loss.",
    "Do cancer patients need blood?":
      "Yes, chemotherapy often lowers blood counts, requiring transfusions.",
    "Do trauma patients need blood?":
      "Yes, accident and injury victims may require urgent transfusions.",
    "Do burn patients need blood?":
      "Yes, they often need plasma to replace fluids and proteins.",
    "Do transplant patients need blood?":
      "Yes, both organ and bone marrow transplants require transfusions.",
    "Do patients with blood disorders need transfusions?":
      "Yes, conditions like thalassemia and sickle cell disease require regular blood.",
    "What is thalassemia?":
      "A genetic disorder where the body produces abnormal hemoglobin.",
    "What is sickle cell disease?":
      "A genetic condition where red blood cells become sickle-shaped, causing anemia and pain.",
    "How often do these patients need blood?":
      "Sometimes every few weeks for life.",
    "Are there other uses for donated blood?":
      "Yes, it's also used in medical research and training.",
    "Is blood used for research?":
      "Yes, surplus blood may support medical studies.",
    "Can I donate if I'm taking medication?":
      "Yes, in most cases you can donate, but it depends on the type of medication and condition. Some medicines may temporarily defer you. Always inform the blood center before donating.",
    "What are blood-derived products?":
      "Medications like albumin, clotting factors, and antibodies made from plasma.",
    "How is plasma used in pharmaceuticals?":
      "It helps produce treatments for immune deficiencies and bleeding disorders.",
    "What are the economic benefits of blood donation?":
      "It reduces costs for patients by ensuring availability and preventing shortages.",
    "Does donation reduce healthcare costs?":
      "Yes, by lowering the need for emergency imports and costly alternatives.",
    "Are donors compensated for donation?":
      "No, most countries follow voluntary, unpaid donation systems.",
    "Why is blood donation voluntary?":
      "Because it ensures safety and reduces risks from paid donations.",
    "What are the personal benefits of donation?":
      "You get free health screening, a sense of helping others, and may reduce iron overload.",
    "Does donation provide health benefits?":
      "Yes, it may lower risks of heart disease and iron overload.",
    "Does donation reduce heart disease risk?":
      "Some studies suggest regular donation may reduce risk by lowering iron levels.",
    "Does donation reduce cancer risk?":
      "It may reduce risk related to iron overload, but evidence is limited.",
    "Does donation help with weight management?":
      "Not significantly—it burns about 600 calories per donation.",
    "Does donation improve mental health?":
      "Yes, helping others improves mood and well-being.",
    "Does donation provide a sense of purpose?":
      "Yes, many donors feel pride in saving lives.",
    "Can I get time off work for donation?":
      "In some countries, employers give paid time off for donors.",
    "Are there tax benefits for donation?":
      "In some countries, yes; in others, no.",
    "Do I get any rewards for donation?":
      "Some centers provide T-shirts, badges, or donor cards.",
    "Can I donate if I've recently traveled?":
      "Yes, but it depends on where you traveled. If the area has malaria, Zika, or similar risks, you may be deferred for a period (often 1–12 months). Always tell the blood center your travel history.",
    "How can I track my donations?":
      "Through donor apps, websites, or records provided by centers.",
    "What milestones can I achieve?":
      "Donating 1 gallon, 5 gallons, 10 gallons, or 50+ times over a lifetime.",
    "How are frequent donors recognized?":
      "With pins, certificates, or public appreciation events.",
    "What is the blood donation process like?":
      "The blood donation process is simple and safe. First, you register and complete a quick health check, including questions about your medical history, travel, blood pressure, and a small test for hemoglobin levels. If you’re eligible, a sterile needle is used to draw about 350–450 ml of blood, which usually takes 8–10 minutes. After donation, you rest for a short while and are given snacks and drinks to help your body recover before leaving.",
    "Can I donate in memory of someone?":
      "Yes, you can dedicate donations in memory.",
    "How can I encourage others to donate?":
      "By sharing your story, hosting drives, or inviting friends.",
    "What is the social impact of blood donation?":
      "It strengthens communities and saves lives.",
    "How does donation strengthen community?":
      "It builds solidarity, compassion, and resilience.",
    "How does donation during disasters help?":
      "It ensures patients get urgent transfusions in crises.",
    "What is the global need for blood?":
      "WHO estimates a need of about 120 million donations each year worldwide.",
    "How does my donation impact worldwide?":
      "Every unit adds to the global blood supply, supporting both local and international needs.",

    // Emergency & Urgent Needs (376-425)
    "What constitutes a blood emergency?":
      "When blood supply drops critically low or sudden high demand arises (accidents, disasters, surgeries).",
    "How are emergency blood needs communicated?":
      "Through donor alerts, phone calls, texts, emails, and social media campaigns.",
    "What blood types are needed most in emergencies?":
      "O-negative (universal donor) and O-positive (most common).",
    "Why is there often blood shortages?":
      "Because demand is constant, but donations fluctuate.",
    "When do blood shortages typically occur?":
      "During holidays, summer, and flu season when fewer people donate.",
    "Are there seasonal variations in blood supply?":
      "Yes, donations usually drop in summer and holidays.",
    "Why are holidays challenging for blood supply?":
      "Fewer donors are available while accidents often increase.",
    "How does weather affect blood donations?":
      "Storms, floods, or extreme heat/cold can reduce turnout.",
    "What events can cause increased blood demand?":
      "Accidents, surgeries, natural disasters, and mass casualty events.",
    "How do natural disasters affect blood supply?":
      "They disrupt donation drives while increasing urgent needs.",
    "How do mass casualty events affect blood supply?":
      "They cause sudden, extreme demand for blood.",
    "What is a blood inventory management?":
      "The system blood banks use to monitor, store, and distribute blood.",
    "How is blood supply monitored?":
      "By tracking daily collections, usage, and storage levels.",
    "Does donating blood hurt?":
      "It only feels like a quick pinch; it doesn’t really hurt.",
    "How are donors alerted during shortages?":
      "Through urgent appeals via phone, SMS, social media, or news.",
    "What is a blood drive emergency appeal?":
      "A campaign to urgently recruit donors when supply is low.",
    "What should I do before donating?":
      "Eat a healthy meal, drink plenty of water, get good rest, and avoid alcohol or fatty foods.",
    "What is a blood drive emergency appeal?":
      "A campaign to urgently recruit donors when supply is low.",
    "What should I do after donating? ":
      "Rest for a while, drink fluids, eat a snack, avoid heavy exercise, and keep the bandage on for a few hours. ",

    "How can I help during blood emergencies?":
      "Donate blood, spread awareness, and encourage others to donate.",
    "Can I donate more frequently during emergencies?":
      "No, you must follow safe donation intervals.",
    "What is emergency blood rationing?":
      "Hospitals prioritizing blood for the most critical patients.",
    "How are patients prioritized during shortages?":
      "By urgency, survival chances, and medical necessity.",
    "What is a blood bank?":
      "A facility where donated blood is stored, processed, and distributed.",
    "How is blood stored?":
      "Red cells refrigerated, plasma frozen, platelets at room temperature with agitation.",
    "What is the shelf life of red blood cells?":
      "Up to 42 days when refrigerated.",
    "What is the shelf life of platelets?":
      "Only 5–7 days at room temperature.",
    "What is the shelf life of plasma?": "Up to 1 year when frozen.",
    "What is frozen blood?":
      "Blood preserved at very low temperatures for rare types or military use.",
    "How long can frozen blood be stored?":
      "Up to 10 years under special conditions.",
    "What is blood transportation?":
      "The safe delivery of blood between banks and hospitals.",
    "How is blood shipped to where it's needed?":
      "In temperature-controlled containers, often by couuer or medical transport.",
    "What is a blood mobile?":
      "A mobile donation unit (bus or van) set up for collections.",
    "How are mobile blood drives organized?":
      "By coordinating with workplaces, schools, or community groups.",
    "Can I host a blood drive?":
      "Yes, organizations and individuals can sponsor drives.",
    "What are the requirements for hosting a blood drive?":
      "A large space, volunteers, and coordination with a blood bank.",
    "How many donors are needed for a blood drive?":
      "Usually 25–50 donors minimum.",
    "What space is needed for a blood drive?":
      "Enough for registration, screening, donation chairs, and recovery area.",
    "How far in advance should a blood drive be planned?":
      "At least 6–8 weeks.",
    "What support does the blood center provide?":
      "Staff, equipment, supplies, and donor recruitment materials.",
    "Can businesses host blood drives?":
      "Yes, many companies organize corporate drives.",
    "Can schools host blood drives?":
      "Yes, with eligible students, staff, and parents.",
    "Can religious organizations host blood drives?":
      "Yes, many churches, mosques, and temples host drives.",
    "What is a directed donation for surgery?":
      "Blood donated for a specific patient undergoing surgery.",
    "How can I donate for a specific patient?":
      "Ask the hospital or blood bank about directed donation programs.",
    "What is autologous transfusion?":
      "When patients donate their own blood before planned surgery.",
    "Can I store my own blood for surgery?":
      "Yes, through autologous donation with doctor approval.",
    "How far in advance must I donate for surgery?":
      "Usually 1–6 weeks before the operation.",
    "What is intraoperative blood salvage?":
      "Recycling a patient's own blood lost during surgery.",
    "What is hemodilution?":
      "Diluting a patient's blood before surgery and returning it afterward.",
    "What are blood conservation techniques?":
      "Strategies to minimize blood loss and transfusion needs.",
    "How can blood use be reduced in surgery?":
      "Through advanced surgical techniques and conservation methods.",
    "What are alternatives to blood transfusion?":
      "Volume expanders, synthetic oxygen carriers, and medications to boost red cells.",

    // Website & Technical (426-450)
    "How do I create an account on your website?":
      "Click the Sign Up or Register button, fill in your details, and confirm via email.",
    "How do I reset my password?":
      "Use the Forgot Password link on the login page and follow the instructions sent to your email.",
    "How do I update my personal information?":
      "Log in, go to your Profile/Account Settings, and edit the necessary details.",
    "How do I find blood drives near me?":
      "Use the Find Drives/Donation Centers search feature on the website or app.",
    "How do I search by location?":
      "Enter your city, ZIP code, or area name in the search box.",
    "How do I filter search results?":
      "By date, location, blood type needed, or type of donation (whole blood, plasma, platelets).",
    "How do I schedule an appointment online?":
      "Select a center or drive, choose a time slot, and confirm booking online.",
    "Can I schedule multiple appointments?":
      "Yes, but only within the eligible donation intervals.",
    "How do I cancel an appointment?":
      "Log in and select Cancel Appointment in your dashboard.",
    "How do I reschedule an appointment?":
      "Cancel the old one and book a new slot via the website or app.",
    "How do I view my donation history?":
      "Check your Profile/Donation History in your account.",
    "How do I track my blood type?":
      "It is recorded after your first donation and shown in your account or donor card.",
    "How do I see where my blood was used?":
      "Some centers provide anonymous updates on how your blood was used (but not the patient's identity).",
    "How do I download my donation records?":
      "Go to Donation History and select Download/Export (PDF or CSV).",
    "How do I refer a friend to donate?":
      "Use the referral link or invite feature in your account.",
    "How does the referral program work?":
      "You invite friends, and both of you may earn points, badges, or rewards.",
    "How do I earn rewards points?":
      "By donating regularly, referring friends, or participating in campaigns.",
    "How do I redeem rewards?":
      "Log in to your account, check your points balance, and select available rewards.",
    "How do I contact customer service?":
      "Via the Contact Us page, phone number, or live chat on the website.",
    "Is there a mobile app available?":
      "Yes, many blood services offer an official app.",
    "How do I download the mobile app?":
      "From the Google Play Store (Android) or App Store (iOS).",
    "What features are available on the app?":
      "Appointment booking, donation reminders, history tracking, rewards, and notifications.",
    "How do I enable notifications?":
      "In the app settings, allow push notifications.",
    "How do I change notification settings?":
      "Go to App Settings or Profile Settings and adjust preferences.",
    "How is my data privacy protected?":
      "Your data is secured with encryption and protected by strict privacy policies.",
    // Eligibility
    "What are the basic requirements?":
      "To donate blood, a person must generally be in good health, at least 17 years old (16 with parental consent in some places), and weigh a minimum of around 50 kg (110 lbs). Donors should not have recent infections, chronic illnesses, or certain medical conditions that could affect blood safety. They must avoid high-risk behaviors, recent tattoos or piercings, and certain medications that can temporarily defer donation. Additionally, there are specific guidelines regarding pregnancy, recent surgeries, and travel to regions with infectious disease risks. Blood pressure, hemoglobin levels, and overall health are usually checked before donation to ensure both donor safety and the safety of the blood supply.",
    "Is there a minimum age for blood donation?":
      "Yes, usually 17 years (16 with parental consent in some places).",
    "Can I donate if I have tattoos?":
      "Yes, if your tattoo was done in a licensed facility and is older than 3–6 months.",
    "Can I donate if I'm taking medication?":
      "Yes, in most cases, but some medications require a temporary deferral.",
    "Can I donate if I've recently traveled?":
      "Yes, unless you visited areas with malaria or similar risks, which may require waiting.",

    // Process
    "What is the blood donation process like?":
      "Registration, quick health check, blood draw (8–10 minutes), then rest and refreshment.",
    "How long does a blood donation take?":
      "Around 30–45 minutes total, including registration and rest.",
    "Does donating blood hurt?":
      "Only a quick pinch when the needle goes in; generally not painful.",
    "What should I do before donating?":
      "Eat a healthy meal, drink water, rest well, avoid alcohol and fatty foods.",
    "What should I do after donating?":
      "Rest briefly, drink fluids, eat a snack, avoid heavy exercise, keep the bandage on.",

    // Health
    "Is donating blood safe?":
      "Yes, it’s safe; sterile equipment is always used.",
    "What are the side effects?":
      "Mild dizziness, bruising, or fatigue, which usually pass quickly.",
    "How often can I donate blood?":
      "Every 3 months for men and every 4 months for women.",
    "Will donating blood weaken my immune system?":
      "No, your body quickly replaces the donated blood.",
    "Can I get AIDS from donating blood?":
      "No, sterile single-use needles are used, so there’s no risk.",

    // Blood Types
    "What are the different blood types?":
      "A, B, AB, and O; each can be positive or negative.",
    "What is the rarest blood type?":
      "AB-negative, found in less than 1% of people.",
    "What is a universal donor?":
      "O-negative blood, which can be given to anyone in emergencies.",
    "What is a universal recipient?":
      "AB-positive, which can receive any blood type.",
    "Why is O-negative blood special?":
      "It’s vital for emergencies since anyone can receive it.",

    // Website
    "How do I create an account?":
      "Click 'Sign Up,' enter your details, and verify your email or phone.",
    "How do I find donation centers?":
      "Use the 'Find a Center' option on the website or app.",
    "How do I schedule an appointment?":
      "Log in, choose a center, select date and time, then confirm.",
    "How do I update my information?":
      "Go to 'Profile' or 'Settings' and edit your details.",
    "How do I reset my password?":
      "Click 'Forgot Password' and follow the reset link sent to your email.",

    // Emergency
    "How do I request blood in an emergency?":
      "Call the hotline or request through the emergency section online.",
    "How quickly can I get blood?":
      "Usually within a few hours, depending on availability.",
    "What is your emergency hotline?":
      "Our hotline number is provided on the website and app.",
    "What information do I need to provide?":
      "Patient name, blood type, hospital, and contact details.",
    "Do you deliver to hospitals?":
      "Yes, blood can be delivered directly to hospitals.",

    // Resources
    "Where can I learn more?": "Visit our website’s resources section.",
    "Educational materials":
      "Guides, brochures, and videos about blood donation.",
    "Research about blood donation":
      "Latest studies and scientific information.",
    "Statistics about blood needs":
      "Facts and figures showing why donations are vital.",

    // Support
    "Contact support": "Use the 'Contact Us' page, email, or call support.",
    "Report a problem": "Submit an issue through the support form or email us.",
    "Provide feedback": "Share suggestions on the feedback page or by email.",
    "Technical issues":
      "Clear your cache or contact support if problems continue.",

    // Default response for unknown questions
    default:
      "I'm sorry. I don't have enough information to help with that. Our team can definitely assist you. You can reach them by calling 01560023170 or sending an email to info@lifeshare.com.",
  };

  // Suggestion categories and questions
  const suggestionCategories = {
    main: {
      title: "Main Topics",
      questions: [
        "Eligibility Requirements",
        "Donation Process",
        "Health & Safety",
        "Blood Types",
        "Website Help",
        // "Emergency Services",
        // "Resources & Information",
        "Customer Support",
      ],
    },
    eligibility: {
      title: "Eligibility Requirements",
      questions: [
        "What are the basic requirements?",
        "Is there a minimum age for blood donation?",
        "Can I donate if I have tattoos?",
        "Can I donate if I'm taking medication?",
        // "Can I donate if I've recently traveled?",
      ],
    },
    process: {
      title: "Donation Process",
      questions: [
        "What is the blood donation process like?",
        // "How long does a blood donation take?",
        "Does donating blood hurt?",
        "What should I do before donating?",
        "What should I do after donating?",
      ],
    },
    health: {
      title: "Health & Safety",
      questions: [
        "Is donating blood safe?",
        "What are the side effects?",
        "How often can I donate blood?",
        "Will donating blood weaken my immune system?",
        "Can I get AIDS from donating blood?",
      ],
    },
    types: {
      title: "Blood Types",
      questions: [
        "What are the different blood types?",
        "What is the rarest blood type?",
        "What is a universal donor?",
        "What is a universal recipient?",
        "Why is O-negative blood special?",
      ],
    },
    website: {
      title: "Website Help",
      questions: [
        "How do I create an account?",
        "How do I find donation centers?",
        "How do I schedule an appointment?",
        "what can you do?",
        "How do I reset my password?",
      ],
    },
    emergency: {
      title: "Emergency Services",
      questions: [
        "How do I request blood in an emergency?",
        "How quickly can I get blood?",
        "What is your emergency hotline?",
        "What information do I need to provide?",
        "Do you deliver to hospitals?",
      ],
    },
    resources: {
      title: "Resources & Information",
      questions: [
        "Where can I learn more?",
        "Educational materials",
        "Research about blood donation",
        "Statistics about blood needs",
      ],
    },
    support: {
      title: "Customer Support",
      questions: [
        "Contact support",
        "Report a problem",
        "Provide feedback",
        "Technical issues",
      ],
    },
  };

  // Function to add a message to the chat
  function addMessage(text, isUser) {
    const messageDiv = document.createElement("div");
    messageDiv.classList.add("message");
    messageDiv.classList.add(isUser ? "user-message" : "bot-message");

    const time = new Date().toLocaleTimeString([], {
      hour: "2-digit",
      minute: "2-digit",
    });

    messageDiv.innerHTML = `
                    <div>${text}</div>
                    <div class="message-time">${time}</div>
                `;

    chatMessages.appendChild(messageDiv);

    // Scroll to the bottom of the chat
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  // Function to simulate typing indicator
  function showTypingIndicator() {
    typingIndicator.style.display = "block";
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function hideTypingIndicator() {
    typingIndicator.style.display = "none";
  }

  // Function to update suggested questions
  function updateSuggestedQuestions(category = "main") {
    suggestedQuestionsContainer.innerHTML = "";
    const categoryData = suggestionCategories[category];

    categoryData.questions.forEach((question) => {
      const chip = document.createElement("div");
      chip.classList.add("question-chip");
      chip.setAttribute("data-question", question);
      chip.innerHTML = `<i class="fas fa-arrow-right"></i> ${question}`;

      chip.addEventListener("click", function () {
        const questionText = this.getAttribute("data-question");

        if (questionText === "Back to main topics") {
          updateSuggestedQuestions("main");
          suggestionHistory = ["main"];
          backBtn.disabled = true;
          return;
        }

        // Check if it's a category header
        const categoryKeys = Object.keys(suggestionCategories);
        for (const key of categoryKeys) {
          if (suggestionCategories[key].title === questionText) {
            suggestionHistory.push(key);
            backBtn.disabled = false;
            updateSuggestedQuestions(key);
            return;
          }
        }

        // It's a regular question
        userInput.value = questionText;
        handleUserMessage();
      });

      suggestedQuestionsContainer.appendChild(chip);
    });
  }

  // Function to check for advanced matching patterns
  function advancedMatching(userMessage) {
    userMessage = userMessage.toLowerCase().trim();

    // Check for gratitude expressions
    if (userMessage.includes("thank") || userMessage.includes("appreciate")) {
      return knowledgeBase["thank you"];
    }

    // Check for capability questions
    if (
      userMessage.includes("what can you") ||
      userMessage.includes("what do you do")
    ) {
      return knowledgeBase["what can you do"];
    }

    // Check for help requests
    if (userMessage === "help" || userMessage.includes("how to use")) {
      return knowledgeBase["help"];
    }

    return null;
  }

  // Function to generate a response based on user input
  function generateResponse(userMessage) {
    userMessage = userMessage.toLowerCase();

    // First check with advanced matching
    const advancedMatch = advancedMatching(userMessage);
    if (advancedMatch) return advancedMatch;

    // Check for exact matches first
    for (const [question, answer] of Object.entries(knowledgeBase)) {
      if (userMessage === question.toLowerCase()) {
        return answer;
      }
    }

    // Check for partial matches
    for (const [question, answer] of Object.entries(knowledgeBase)) {
      if (
        userMessage.includes(question.toLowerCase()) ||
        question.toLowerCase().includes(userMessage)
      ) {
        return answer;
      }
    }

    // Check for keywords
    if (
      userMessage.includes("eligibility") ||
      userMessage.includes("eligible") ||
      userMessage.includes("qualify") ||
      userMessage.includes("requirement")
    ) {
      return knowledgeBase["What are the basic requirements to donate blood?"];
    } else if (
      userMessage.includes("process") ||
      userMessage.includes("procedure") ||
      userMessage.includes("donate")
    ) {
      return "The blood donation process typically takes about an hour. It includes registration, a health screening, the donation itself (8-10 minutes), and refreshments afterward.";
    } else if (
      userMessage.includes("safe") ||
      userMessage.includes("risk") ||
      userMessage.includes("side effect")
    ) {
      return "Yes, donating blood is very safe. New, sterile equipment is used for each donor, so there's no risk of contracting any disease.";
    } else if (
      userMessage.includes("type") ||
      userMessage.includes("blood group")
    ) {
      return "The main blood types are A, B, AB, and O, each of which can be Rh-positive or Rh-negative. O-negative is the universal donor.";
    } else if (
      userMessage.includes("website") ||
      userMessage.includes("account") ||
      userMessage.includes("register")
    ) {
      return "Click on the 'Register' button at the top right of our website. You'll need to provide some basic information and verify your email address.";
    } else if (
      userMessage.includes("emergency") ||
      userMessage.includes("urgent") ||
      userMessage.includes("need blood")
    ) {
      return "Use our emergency request form or call our 24/7 hotline. Please provide as many details as possible about the blood type needed and hospital information.";
    } else if (userMessage.includes("universal recipient")) {
      return "AB-positive is the universal recipient because people with this blood type can receive blood from any other type.";
    } else if (
      userMessage.includes("how quickly") ||
      userMessage.includes("how fast") ||
      userMessage.includes("how long")
    ) {
      return "In life-threatening emergencies, blood can be available within minutes at hospital blood banks. For non-emergency requests, it typically takes 1-2 hours to arrange delivery.";
    }

    // Default response for unknown questions
    return knowledgeBase["default"];
  }

  // Function to handle user message
  function handleUserMessage() {
    const message = userInput.value.trim();

    if (message !== "") {
      // Add user message to chat
      addMessage(message, true);
      userInput.value = "";

      // Add to conversation history
      conversationHistory.push({
        type: "user",
        content: message,
        time: new Date(),
      });

      // Show typing indicator
      showTypingIndicator();

      // Generate and display response after a short delay
      setTimeout(() => {
        hideTypingIndicator();
        const botResponse = generateResponse(message);

        if (botResponse === knowledgeBase["default"]) {
          addMessage(botResponse, false);
        } else {
          addMessage(botResponse, false);
        }

        // Add to conversation history
        conversationHistory.push({
          type: "bot",
          content: botResponse,
          time: new Date(),
        });
      }, 1500);
    }
  }

  // Event listeners
  sendButton.addEventListener("click", handleUserMessage);

  userInput.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      handleUserMessage();
    }
  });

  // Toggle suggestions
  toggleSuggestionsBtn.addEventListener("click", function () {
    suggestionsEnabled = !suggestionsEnabled;
    if (suggestionsEnabled) {
      this.innerHTML = '<i class="fas fa-lightbulb"></i> Suggestions: ON';
      suggestedQuestionsContainer.style.display = "flex";
      document.querySelector(".suggestion-nav").style.display = "flex";
    } else {
      this.innerHTML = '<i class="fas fa-lightbulb"></i> Suggestions: OFF';
      suggestedQuestionsContainer.style.display = "none";
      document.querySelector(".suggestion-nav").style.display = "none";
    }
  });

  // Navigation buttons
  homeBtn.addEventListener("click", function () {
    suggestionHistory = ["main"];
    backBtn.disabled = true;
    updateSuggestedQuestions("main");
  });

  backBtn.addEventListener("click", function () {
    if (suggestionHistory.length > 1) {
      suggestionHistory.pop();
      const prevCategory = suggestionHistory[suggestionHistory.length - 1];
      updateSuggestedQuestions(prevCategory);

      if (suggestionHistory.length === 1) {
        backBtn.disabled = true;
      }
    }
  });

  moreBtn.addEventListener("click", function () {
    // Cycle through categories
    const categories = Object.keys(suggestionCategories);
    const currentCategory = suggestionHistory[suggestionHistory.length - 1];
    const currentIndex = categories.indexOf(currentCategory);
    const nextIndex = (currentIndex + 1) % categories.length;
    const nextCategory = categories[nextIndex];

    suggestionHistory.push(nextCategory);
    backBtn.disabled = false;
    updateSuggestedQuestions(nextCategory);
  });

  updateSuggestedQuestions();

  userInput.focus();
});

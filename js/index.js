document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  // const page = urlParams.get("page");
  let currentURI = window.location.pathname.split("/").pop();
  currentURI = currentURI.replace(".php", "");
  console.log(currentURI);

  const tutorialDiv = document.getElementById("tutorial");
  const logout = document.getElementById("logout");
  const questionsContainer = document.getElementById("questions-container");
  var currentQuestion = 0;
  var questions = document.querySelectorAll(".question");
  // const textarea = document.getQuerySelector("textarea");
  tinymce.init({
    selector: "textarea",
    plugins:
      "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
    toolbar:
      "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",
  });

  function loginUser(loginForm) {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Add validation (e.g., check if email and password are not empty)
    if (email.trim() === "" || password.trim() === "") {
      alert("Please enter both email and password.");
      return;
    }

    const formData = new FormData(loginForm);

    // Simulate sending login request to server
    fetch("./includes/functions.php?action=login", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Login successful"); // Replace with actual redirect or action
          window.location.href = "index.php?page=dashboard";
        } else {
          alert("Login failed. Please check your credentials."); // Show error message
        }
      })
      .catch((error) => console.error("Error:", error));
  }

  function registerUser(registerForm) {
    const fullName = document.getElementById("fullName").value;
    const userName = document.getElementById("userName").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;

    if (
      fullName.trim() === "" ||
      userName.trim() === "" ||
      email.trim() === "" ||
      password.trim() === "" ||
      confirmPassword.trim() === ""
    ) {
      alert("All fields are required!");
      return;
    }

    if (password !== confirmPassword) {
      alert("Passwords do not match!");
      return;
    }

    // Send form data to server
    const formData = new FormData(registerForm);
    console.log(formData);

    fetch("./includes/functions.php?action=register", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Registration successful!");
          window.location.href = "index.php?page=login";
        } else {
          alert(data.message);
        }
      })
      .catch((error) => console.error("Error:", error));
  }

  function getQuestion(index) {
    const questionsContainer = document.getElementById("questionsContainer");

    fetch("./includes/functions.php?action=getQuestion", {
      method: "POST",
      body: JSON.stringify({ index: index }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          questionsContainer.innerHTML = `
                <div class="question">
                    <h2>Question ${index + 1}:</h2>
                    <p>${data.question.question_text}</p>
                    <label>
                        <input type="radio" name="q${index + 1}" value="a"> ${
            data.question.option_a
          }
                    </label>
                    <label>
                        <input type="radio" name="q${index + 1}" value="b"> ${
            data.question.option_b
          }
                    </label>
                    <label>
                        <input type="radio" name="q${index + 1}" value="c"> ${
            data.question.option_c
          }
                    </label>
                </div>
            `;
        } else {
          alert(data.message);
        }
      })
      .catch((error) => console.error("Error:", error));
  }

  function nextQuestion() {
    currentQuestion++;
    getQuestion(currentQuestion);
    document.getElementById("prevButton").disabled = false;
  }

  function prevQuestion() {
    if (currentQuestion > 0) {
      currentQuestion--;
      getQuestion(currentQuestion);
      if (currentQuestion === 0) {
        document.getElementById("prevButton").disabled = true;
      }
    }
  }

  // Initial call to load the first question

  switch (currentURI) {
    case "login":
      const loginForm = document.getElementById("loginForm");
      if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
          e.preventDefault();
          loginUser(loginForm);
        });
      }

      break;
    case "register":
      const registerForm = document.getElementById("registerForm");

      registerForm.addEventListener("submit", function (event) {
        event.preventDefault();
        registerUser(registerForm);
      });

      break;
    case "module":
      const urlParams = new URLSearchParams(window.location.search);
      const module_id = urlParams.get("module_id");

      let currentStep = 0;
      let stepsData = [];

      document.getElementById("next-btn").addEventListener("click", nextStep);
      document.getElementById("prev-btn").addEventListener("click", prevStep);

      function showCurrentStep(stepIndex) {
        const steps = document.querySelectorAll(".learning_module");

        steps.forEach((step, index) => {
          if (index === stepIndex) {
            step.style.display = "flex";
          } else {
            step.style.display = "none";
          }
        });
      }

      function finishModule() {
        window.location.href = `index.php`;
      }

      function nextStep() {
        if (currentStep < stepsData.length - 1) {
          currentStep++;
          showCurrentStep(currentStep);
        } else {
          document.getElementById("next-btn").textContent = "Finish";
          document
            .getElementById("next-btn")
            .addEventListener("click", finishModule);
        }
      }

      function prevStep() {
        if (currentStep > 0) {
          currentStep--;
          showCurrentStep(currentStep);
        }
      }

      function fetchModuleSteps(moduleId) {
        fetch(
          `./includes/functions.php?action=getModuleSteps&module_id=${moduleId}`
        )
          .then((response) => response.json())
          .then((data) => {
            const steps = data.steps;
            const stepsContainer = document.getElementById("moduleSteps");

            stepsContainer.innerHTML = "";

            steps.forEach((step) => {
              const stepDiv = document.createElement("div");
              stepDiv.className = "learning_module";
              stepDiv.innerHTML = `
                <div class="learning_left">
                    <img src="${step.image_path}" class="learning_img" alt="Step Image" title="Source: ">
                </div>
                <div class="learning_right">
                    <h2 class="">${step.step_number} : ${step.step_title}</h2>
                    ${step.step_description}
                </div>
              `;
              stepsContainer.appendChild(stepDiv);
            });

            stepsData = steps;
            showCurrentStep(currentStep);
          })
          .catch((error) => console.error("Error:", error));
      }

      fetchModuleSteps(module_id);

      break;
    case "quiz":
      getQuestion(currentQuestion);

      break;

    default:
      break;
  }
});

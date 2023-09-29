document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const page = urlParams.get("page");

  const tutorialDiv = document.getElementById("tutorial");

  let currentStep = 0;
  let stepsData = [];
  let currentQuestion = 0;
  const questionsContainer = document.getElementById("questions-container");

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

  function fetchComponents() {
    fetch("./includes/functions.php?action=getComponents")
      .then((response) => response.json())
      .then((data) => {
        data.forEach((component) => {
          const componentDiv = document.createElement("div");
          componentDiv.className = "component";
          componentDiv.innerHTML = `
          <h2>${component.name}</h2>
          <p>${component.description}</p>
        `;
          document.getElementById("componentList").appendChild(componentDiv);
        });
      })
      .catch((error) => console.error("Error:", error));
  }
  function fetchModuleSteps(moduleId) {
    fetch(
      `./includes/functions.php?action=getModuleSteps&module_id=${moduleId}`
    )
      .then((response) => response.json())
      .then((data) => {
        const steps = data.steps;
        const stepsContainer = document.getElementById("moduleSteps");

        stepsContainer.innerHTML = ""; // Clear previous steps

        steps.forEach((step) => {
          const stepDiv = document.createElement("div");
          stepDiv.className = "module-step";
          stepDiv.innerHTML = `
          <h3>Step ${step.step_number}</h3>
          <p>${step.step_description}</p>
          <img src="${step.image_url}" alt="Step Image">
        `;
          stepsContainer.appendChild(stepDiv);
        });
      })
      .catch((error) => console.error("Error:", error));
  }

  const moduleData = [];

  let currentModuleIndex = 0;

  function displayModule(moduleIndex) {
    const module = moduleData[moduleIndex];
    document.getElementById("moduleImage").src = module.image_url;
    document.getElementById("moduleName").textContent = module.name;
    document.getElementById("moduleDescription").textContent =
      module.description;

    // Fetch and display steps for the current module
    fetchModuleSteps(module.id);
  }

  document.getElementById("prevButton").addEventListener("click", function () {
    if (currentModuleIndex > 0) {
      currentModuleIndex--;
      displayModule(currentModuleIndex);
    }
  });

  document.getElementById("nextButton").addEventListener("click", function () {
    if (currentModuleIndex < moduleData.length - 1) {
      currentModuleIndex++;
      displayModule(currentModuleIndex);
    }
  });

  // Display the initial module
  displayModule(currentModuleIndex);
});

(() => {
  const assignment = document.getElementById("assignment-type");
  if (!assignment) return;

  const form = assignment.form;
  const startGroup = form.querySelector("[data-start-date]");
  const endGroup = form.querySelector("[data-end-date]");
  const startLabel = form.querySelector("[data-start-label]");
  const startInput = form.elements.startDate;
  const endInput = form.elements.endDate;

  function updateDates() {
    const value = assignment.value;
    const needsStart = value && value !== "Not sure yet";
    const needsEnd = value === "Temporary protection" || value === "International travel protection";

    startGroup.hidden = !needsStart;
    startInput.required = Boolean(needsStart);
    startLabel.textContent = value === "One-day assignment" ? "Assignment date *" : "Start date *";

    endGroup.hidden = !needsEnd;
    endInput.required = needsEnd;
    if (!needsEnd) endInput.value = "";
  }

  assignment.addEventListener("change", updateDates);
  updateDates();
})();

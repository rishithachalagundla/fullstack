let students = [
  { name: "Ravi", dept: "CSE", date: "2023-06-10" },
  { name: "Anu", dept: "ECE", date: "2022-02-12" },
  { name: "Kiran", dept: "MBA", date: "2024-01-05" },
  { name: "Sneha", dept: "CSE", date: "2021-09-18" },
  { name: "Arjun", dept: "ECE", date: "2023-11-20" }
];

function renderTable(data) {
  const body = document.getElementById("tableBody");
  body.innerHTML = "";

  data.forEach(s => {
    body.innerHTML += `
      <tr>
        <td>${s.name}</td>
        <td>${s.dept}</td>
        <td>${s.date}</td>
      </tr>`;
  });
}

function countDepartments(data) {
  const counts = {};
  data.forEach(s => {
    counts[s.dept] = (counts[s.dept] || 0) + 1;
  });

  const list = document.getElementById("countList");
  list.innerHTML = "";

  for (let dept in counts) {
    list.innerHTML += `<li>${dept}: ${counts[dept]}</li>`;
  }
}

function applyChanges() {
  let filtered = [...students];
  const dept = document.getElementById("deptFilter").value;
  if (dept !== "All") {
    filtered = filtered.filter(s => s.dept === dept);
  }
  const sortOption = document.getElementById("sortOption").value;
  if (sortOption === "name") {
    filtered.sort((a, b) => a.name.localeCompare(b.name));
  } else if (sortOption === "date") {
    filtered.sort((a, b) => new Date(a.date) - new Date(b.date));
  }

  renderTable(filtered);
  countDepartments(filtered);
}
renderTable(students);
countDepartments(students);

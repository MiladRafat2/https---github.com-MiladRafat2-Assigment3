//  API to retrieve data
const apiEndpoint = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

async function fetchData() {
  try {
    const response = await fetch(apiEndpoint);
    if (!response.ok) throw new Error("Failed to fetch data");

    const data = await response.json();
    populateTable(data.records);
  } catch (error) {
    console.error("Error:", error);
  }
}


function populateTable(records) {
  const tableBody = document.getElementById("studentTable").querySelector("tbody");
  tableBody.innerHTML = ""; // Clear any existing data

  records.forEach(record => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${record.fields.nationality || "Unknown"}</td>
      <td>${record.fields.gender || "Unknown"}</td>
      <td>${record.fields.enrolled_students || 0}</td>
    `;
    tableBody.appendChild(row);
  });
}

// Fetch & display the data on page load
fetchData();

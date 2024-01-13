<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
    <main>
        <section>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Add New Car</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="car_form">
                    <div class="mb-3">
                        <label class="form-label" for="licensePlateNumber">License plate number:</label>
                        <input class="form-control" type="text" id="licensePlateNumber">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="brand">Brand:</label>
                        <input class="form-control" type="text" id="brand">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="model">Model:</label>
                        <input class="form-control" type="text" id="model">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="yearOfManufacture">Year of manufacture:</label>
                        <input class="form-control" type="text" id="yearOfManufacture">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="fuelType">Fuel type:</label>
                        <input class="form-control" type="text" id="fuelType">
                    </div>

                    <button class="btn btn-primary" id="newCarButton">Create New Car</button>
                </form>
            </div>
        </div>
    </div>
</main>
</section>
<section class="mt-3">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Registered cars</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>License-plate-number</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Year of Manufacture</th>
                            <th>Fuel type</th>
                        </tr>
                    </thead>
                    <tbody id="cars_table">
                        
                    </tbody>
                </table>
</section>
<script>
document.addEventListener('DOMContentLoaded',(getAllCars()));
async function getAllCars() {
    const result = await fetch('/api/car');
    const allCars = await result.json();
    console.log(allCars);
    const carsTable = document.getElementById('cars_table');
    carsTable.innerHTML="";
    allCars.forEach(car => {
        const tr = document.createElement("tr");
        const idTd = document.createElement("td");
        const licensePlateNumberTd = document.createElement("td");
        const brandTd = document.createElement("td");
        const modelTd = document.createElement("td");
        const yearOfManufactureTd = document.createElement("td");
        const fuelTypeTd = document.createElement("td");
        idTd.textContent = car.id;
        licensePlateNumberTd.textContent = car.licensePlateNumber;
        brandTd.textContent = car.brand;
        modelTd.textContent = car.model;
        yearOfManufactureTd.textContent = car.yearOfManufacture;
        fuelTypeTd.textContent = car.fuelType;
        tr.appendChild(idTd);
        tr.appendChild(licensePlateNumberTd);
        tr.appendChild(brandTd);
        tr.appendChild(modelTd);
        tr.appendChild(yearOfManufactureTd);
        tr.appendChild(fuelTypeTd);
        carsTable.appendChild(tr);
    });
}

async function createCars(){
    const licensePlateNumberInput = document.getElementById('licensePlateNumber').value;
    const brandInput = document.getElementById('brand').value;
    const modelInput = document.getElementById('model').value;
    const yearOfManufactureInput = document.getElementById('yearOfManufacture').value;
    const fuelTypeInput = document.getElementById('fuelType').value;
    const result = await fetch('/api/car', {
        method: 'POST',
        body: JSON.stringify({
                licensePlateNumber: licensePlateNumberInput,
                brand: brandInput,
                model: modelInput,
                yearOfManufacture: yearOfManufactureInput,
                fuelType: fuelTypeInput
            }),
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json"
        }
    });
    console.log(result.json());

    if (result.ok) {
        getAllCars();
    }
        else {
            const data = await result.json();
            alert(data.message);
        }
    }

document.getElementById('car_form').addEventListener("submit",(event) => {
    event.preventDefault;
    createCars();
})
</script>
</body>
</html>

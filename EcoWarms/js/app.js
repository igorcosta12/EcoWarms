// Função dropDown

const dropDown = document.querySelectorAll("#dropDown");

dropDown.forEach((btn) => {
    btn.addEventListener("click", () => {
        const dropDownMenu = btn.nextElementSibling

        dropDownMenu.classList.toggle("hidden");
    })
})

// Fechar DropDown com clique em qualquer lugar da tela

document.addEventListener("click", (e) => {
    dropDown.forEach((btn) => {
        const dropDownMenu = btn.nextElementSibling

        if (!btn.contains(e.target) && !dropDownMenu.contains(e.target)) {
            dropDownMenu.classList.add('hidden');
        }
    })
})

// Modal

document.querySelector("#closeModal").addEventListener("click", () => {
    document.querySelector("#modal").classList.add("hidden")
    document.body.classList.toggle("modal-open")
})

// API weather

const API_KEY = "f68bb9bcd75825343655d1dc14d621ab"
const APICountryURL = "https://countryflagsapi.com/png/";

const inputSearh = document.querySelector("#search")
const citySearch = document.querySelector("#searchAPI")

const city = document.querySelector("#city")
const temp = document.querySelector("#temperature span")
const weatherImg = document.querySelector("#weatherImg")
const countryImg = document.querySelector("#country");
const humidity = document.querySelector("#humidity span");
const wind = document.querySelector("#wind span");

const getWeatherData = async (cityName) => {
    const apiWeatherURL = `https://api.openweathermap.org/data/2.5/weather?q=${cityName}&units=metric&appid=${API_KEY }&lang=pt_br`;

    const res = await fetch(apiWeatherURL);
    const data = await res.json();

    return data;
}

const showWeather = async (cityName) => {
    const data = await getWeatherData(cityName)

    city.innerText = data.name
    temp.innerText = parseInt(data.main.temp)
    weatherImg.setAttribute(
        "src",
        `http://openweathermap.org/img/wn/${data.weather[0].icon}.png`
    );

    countryImg.setAttribute("src", `https://flagsapi.com/${data.sys.country}/flat/64.png`);

    humidity.innerText = `${data.main.humidity}%`
    wind.innerText = `${data.wind.speed} km/h`
}

citySearch.addEventListener("click", async (e) => {
    const cityName = e.target.value

    document.querySelector("#modal").classList.remove("hidden")

    document.body.classList.toggle("modal-open")
    
    inputSearh.value = ""

    showWeather(cityName)
})

inputSearh.addEventListener("keyup", e => {
    if (e.code === "Enter") {
        const cityName = e.target.value

        document.querySelector("#modal").classList.remove("hidden")

        inputSearh.value = ""

        document.body.classList.toggle("modal-open")

        showWeather(cityName)
    }
})




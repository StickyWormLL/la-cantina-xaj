const carret = localStorage.getItem("carret")

const xhr = new XMLHttpRequest()
xhr.open("POST", "compraphp", true)
xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8")
xhr.send(carret)


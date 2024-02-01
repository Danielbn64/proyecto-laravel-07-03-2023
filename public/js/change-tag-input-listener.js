"use strict";

const ListAddedtags = document.getElementById("AddedTags");
const inputAddTags = document.getElementById("addTags");
const inputHidden = document.getElementById("imageId");
const removeBtn = document.getElementById("removeTags");
const saveBtn = document.getElementById("saveTags");

let countNumb = document.getElementById("tagsCount");
let maxTags = 10;
let tags = [];

let backspacePressed = false;
let backspaceHoldTimeout;

let controller = new AbortController();

countTag();

function countTag() {
    let paramCountNumb = maxTags - tags.length;
    countNumb.innerText = paramCountNumb;
    return paramCountNumb;
}

function recoverPlaceHolder() {
    let counter = countTag();
    if (counter === 10) {
        inputAddTags.placeholder = "Escribe palabras que describan tu imagen";
        saveBtn.disabled = true;
    }
}

function addTag(e) {
    if (e.key == "Enter") {
        let tag = e.target.value.replace(/\s+/g, " ");
        if (tag.length > 1 && !tags.includes(tag)) {
            saveBtn.disabled = false;
            if (tags.length < 10) {
                tag.split(",").forEach((tag) => {
                    tags.push(tag);
                    createTag();
                    inputAddTags.placeholder = "";
                });
            }
                    }
        e.target.value = "";
        tagListResponse.innerHTML = "";
    }
}

function addTagWithClick() {
    const tagText = this.textContent;
    if (!tags.includes(tagText)) {
        saveBtn.disabled = false;
        if (tags.length < 10) {
            tags.push(tagText);
            createTag();
            inputAddTags.value = "";
            inputAddTags.placeholder = "";
        }
    }
}

function createTag() {
    ListAddedtags.querySelectorAll("li").forEach((li) => li.remove());
    tags.slice()
        .reverse()
        .forEach((tag) => {
            let liTag = `<li>${tag} <i class="uit uit-multiply" onclick="removeTags(this,'${tag}')"></i></li>`;
            ListAddedtags.insertAdjacentHTML("afterbegin", liTag);
        });
    countTag();
    recoverPlaceHolder();
}

function removeTags(element, tag) {
    let index = tags.indexOf(tag);
    tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
    element.parentElement.remove();
    countTag();
    recoverPlaceHolder();
}

inputAddTags.addEventListener("keyup", addTag);

function recomendedTagList() {
    controller.abort();
    controller = new AbortController();
    const inputValue = inputAddTags.value.trim();
    if (inputValue.length > 1) {
        fetch("http://localhost/proyecto-laravel/public/get_tags", {
            signal: controller.signal,
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ input: inputValue }),
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error("Error en la petición");
                }
            })
            .then((data) => {
                tagListResponse.innerHTML = "";
                if (data && data.data && data.data.length > 0) {
                    const tags = data.data;
                    const tagList = document.createElement("div");

                    tags.forEach((tag) => {
                        const listItem = document.createElement("div");

                        listItem.textContent = tag.tags;
                        listItem.onclick = addTagWithClick;
                        tagList.appendChild(listItem);
                    });

                    tagListResponse.appendChild(tagList);
                } else {
                    tagListResponse.textContent = "No se encontraron etiquetas";
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    } else {
        tagListResponse.innerHTML = "";
    }
}

inputAddTags.addEventListener("input", recomendedTagList);

inputAddTags.addEventListener("keyup", function (e) {
    if (e.key === "Backspace") {
        recomendedTagList();
        backspacePressed = false;
        clearTimeout(backspaceHoldTimeout);
    }
});

inputAddTags.addEventListener("keydown", function (e) {
    if (e.key === "Backspace") {
        backspacePressed = true;
        backspaceHoldTimeout = setTimeout(function () {
            if (backspacePressed) {
                const selectionStart = inputAddTags.selectionStart;
                if (selectionStart <= 5) {
                    clearTimeout(backspaceHoldTimeout);
                    inputAddTags.value = "";
                }
                backspacePressed = false;
            }
        }, 200);
    }
});

removeBtn.addEventListener("click", () => {
    tags.length = 0;
    ListAddedtags.querySelectorAll("li").forEach((li) => li.remove());
    tagListResponse.innerHTML = "";
    countTag();
    recoverPlaceHolder();
    saveBtn.disabled = true;
});

saveBtn.addEventListener("click", () => {
    if (tags && tags.length > 0) {
        let imageId = inputHidden.value;
        const tagsJson = JSON.stringify(tags);
        fetch("http://localhost/proyecto-laravel/public/update_images_tags", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ imageId: imageId, tags: tagsJson }),
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error("Error en la petición");
                }
            })
            .then((data) => {
                console.log(data);
            })
            .catch((error) => {
                console.error("Error:", error);
            });
        ListAddedtags.querySelectorAll("li").forEach((li) => li.remove());
        tags.length = 0;
        tagListResponse.innerHTML = "";
        countTag();
        recoverPlaceHolder();
    }
});

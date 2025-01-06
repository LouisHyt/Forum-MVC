const confirmLock = document.querySelector("#confirmLock");
const lockButtons = confirmLock.querySelectorAll(".actions > .button");
const confirmTopicId = confirmLock.querySelector("#confirmTopicId");
const topicCards = document.querySelectorAll(".topic-card");

function setCategoryFilter(e){
    const id = parseInt(e.value);
    console.log(id);
    if(id === 0){
        window.location.replace(`${window.location.pathname}?ctrl=forum&action=index`);
    } else {
        window.location.replace(`${window.location.pathname}?ctrl=forum&action=showByCategory&id=${id}`);
    }
}

function openLockConfirmation(e){
    confirmTopicId.value = e.closest(".topic-card").dataset.id;
    confirmLock.showModal();
}

for(const button of lockButtons){
    button.addEventListener("click", e => {
        const action = e.currentTarget.classList.contains("confirm") ? "confirm" : "deny";
        const topicId = parseInt(confirmTopicId.value);
        if(action === "deny"){
            confirmLock.close();
            return
        }

        const formData = new FormData();
        formData.append("topicId", topicId);

        fetch("?ctrl=topic&action=ajax", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.error){
                console.error(data.error);
                return
            }

            window.location.reload();
        })
        .catch(err => console.error(err))
        confirmLock.close();
    })
}

for(const topicCard of topicCards){
    topicCard.addEventListener("click", e => {
        if (e.target.classList.contains('lock-topic')) {
            return;
        }
        const topicId = topicCard.dataset.id;
        window.location.href = `?ctrl=topic&action=index&id=${topicId}`;
    })
}
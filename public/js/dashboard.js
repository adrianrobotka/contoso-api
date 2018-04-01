// Stores all incoming data
let dataStorage = [];

function fillParticipantBox(box, indexedData) {
    box.removeClass("sample");
    let participant = indexedData.participant;
    let confidence = parseInt(indexedData.confidence * 100);
    let name = participant.lastName + " " + participant.firstName;
    let faces = participant.faces;

    box.find(".name")[0].innerHTML = name;
    box.find(".group")[0].innerHTML = participant.groupName;
    box.find(".confidence")[0].innerHTML = confidence;

    let i = 1;
    faces.forEach(function (face) {
        box.find(".image" + i++)[0].src = face.url;
    });
}

// Build event box
function buildEventBoxFromData(data) {
    let box;

    if (data.event_type !== "identify")
        return;

    if (data.results.length === 1) {

        if (data.results[0].selected != null) {
            // selected identity
            box = $(".event-box.selected-identity.sample").clone().prependTo(".event-boxes");
            fillParticipantBox(box, data.results[0]);
            box.find(".gate")[0].innerHTML = data.gate;
            box.find(".date")[0].innerHTML = data.date;
        }
        else {
            // valid identity
            box = $(".event-box.valid-identity.sample").clone().prependTo(".event-boxes");
            fillParticipantBox(box, data.results[0]);
            box.find(".gate")[0].innerHTML = data.gate;
            box.find(".date")[0].innerHTML = data.date;
        }


    }
    else if (data.results.length > 1) {
        box = $(".event-box.indefinite-identity.sample").clone().prependTo(".event-boxes");
        box.removeClass("sample");
        let indefinites = box.find('.indefinites');
        for (i = 0; i < data.results.length; i++) {
            innerBox = $(".indefinite-participant.sample").clone().prependTo(indefinites);
            fillParticipantBox(innerBox, data.results[i]);
        }

        box.find(".date")[0].innerHTML = data.date;
        box.find(".gate")[0].innerHTML = data.gate;
    }
    else {
        box = $(".event-box.no-identity.sample").clone().prependTo(".event-boxes");
        box.removeClass("sample");
        box.find(".gate")[0].innerHTML = data.gate;
        box.find(".date")[0].innerHTML = data.date;
    }
}

var channel = pusher.subscribe('participant');
channel.bind('participant', function (data) {

    dataStorage.push(data);

    buildEventBoxFromData(data);
});

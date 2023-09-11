gapi.load('client:auth2', function() {
    gapi.client.init({
        apiKey: 'AIzaSyDgpXeCYu0GLDyl_hO1GNsMLYQK-ON8KxA',
        clientId: '563340585191-jroo200tngacde6fb0g3uk3kqup58ovh.apps.googleusercontent.com',
        discoveryDocs: ['https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest'],
        scope: 'https://www.googleapis.com/auth/calendar.readonly'
    }).then(function() {
        var calendar = new google.visualization.Calendar(document.getElementById('calendario'));
        // Configura el calendario aquí
        calendar.draw();
    });
});

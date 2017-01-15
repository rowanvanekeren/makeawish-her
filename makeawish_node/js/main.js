      var localIp = '192.168.1.104';
      var pusherChannel = "blow_a_wish";
      var pusherEvent = "send_wish";
      var relayArray = [8, 9, 10];
      var className = "";
      var debugText = "";
      var debugClass = ".debug";
      var appendDiv = "<div class='" + className + "'> <p>" + debugText + " </p> </div>";
      Pusher.logToConsole = true;
      var pusher = new Pusher('7d5f75a6e8d507102cdb', {
          cluster: 'eu',
          encrypted: true
      });




      var channel = pusher.subscribe(pusherChannel);
      channel.bind(pusherEvent, function (data) {

          $(debugClass).append("<div class='pusher'> <p>" + data + " </p> </div>");
          
          postnow(data);
/*          $.ajax({
              type: 'POST',
              data: JSON.stringify({
                  relay: staticRelay
              }),
              contentType: 'application/json',
              dataType: 'json',
              url: "http://" + localIp + ":8080/relay",
              success: function (data) {
                  $(debugClass).append("<div class='ajaxsucces'> <p>" + data + " </p> </div>");
              },
              error: function (data) {
                  $(debugClass).append("<div class='ajaxerror'> <p>" + data + " </p> </div>");
              }
          });*/

      });

      function postnow(relay) {
          var relayNumber = 0;
          if (relay in relayArray) {
              relayNumber = relay;

              $.ajax({
                  type: 'POST',
                  data: JSON.stringify({
                      relay: relayArray[relayNumber]
                  }),
                  contentType: 'application/json',
                  dataType: 'json',
                  url: "http://" + localIp + ":8080/relay",
                  success: function (data) {
                      $(debugClass).append("<div class='ajaxsucces'> <p>" + data + " </p> </div>");
                  },
                  error: function (data) {
                      $(debugClass).append("<div class='ajaxerror'> <p>" + data + " </p> </div>");
                  }
              });
          }




          /*                    });
                  $.post( "http://" + localIp + ":8080/testapi", function( data ) {
            console.log(data);
          });*/
      }
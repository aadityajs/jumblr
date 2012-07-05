if (typeof Groupon.ui == 'undefined') {
  Groupon.ui = {};
}

Groupon.ui.Alerts = Behavior.create({
  onclick: function(e) {
    $(e.element()).closest('ul.alerts').slideUp("fast");
  }
});

Event.addBehavior({
  'ul.alerts span#close' : Groupon.ui.Alerts
});
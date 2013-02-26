/**
 * This is your App script template. Is already working, all you need to do it build your functions and play :)
 * Here you can already use Jquery, Modernizr and Bootstrap.js
 */
;
(function() {
      var App,
              __bind = function(fn, me) {
            return function() {
                  return fn.apply(me, arguments);
            };
      };

      App = (function() {
            // Constructor
            function App() {
                  this.initialize();
            }

            App.prototype.initialize = function() {
            }

            return App;

      })();

      $(function() {
            return App = new App();
      });

}).call(this);

/**
 * Shamelessly copied from http://stackoverflow.com/questions/1064089/inserting-a-text-where-cursor-is-using-javascript-jquery
 * @param {type} areaId
 * @param {type} text
 * @returns {undefined}
 */
function insertAtCaret(areaId, text) {
      var txtarea = document.getElementById(areaId);
      var scrollPos = txtarea.scrollTop;
      var strPos = 0;
      var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
              "ff" : (document.selection ? "ie" : false));
      if (br == "ie") {
            txtarea.focus();
            var range = document.selection.createRange();
            range.moveStart('character', -txtarea.value.length);
            strPos = range.text.length;
      }
      else if (br == "ff")
            strPos = txtarea.selectionStart;

      var front = (txtarea.value).substring(0, strPos);
      var back = (txtarea.value).substring(strPos, txtarea.value.length);
      txtarea.value = front + text + back;
      strPos = strPos + text.length;
      if (br == "ie") {
            txtarea.focus();
            var range = document.selection.createRange();
            range.moveStart('character', -txtarea.value.length);
            range.moveStart('character', strPos);
            range.moveEnd('character', 0);
            range.select();
      }
      else if (br == "ff") {
            txtarea.selectionStart = strPos;
            txtarea.selectionEnd = strPos;
            txtarea.focus();
      }
      txtarea.scrollTop = scrollPos;
}

 function insertCode(targetId) {

      var enteredCode = $('#codeEditor').val();
      
      var selectedCodeType = $('#selCodeType').val();

      $('#codeEditor').val('');

      $('#selCodeType').val('');


      var preCodeTag = postCodeTag = '';
      if (selectedCodeType) {
            preCodeTag = '\n<srccode type="' + selectedCodeType + '">\n';
            postCodeTag = '\n</srccode>\n';
      }
      var completeCode = preCodeTag + enteredCode + postCodeTag;

 
      try {
            insertAtCaret(targetId, completeCode);
      } catch (e) {
            var currentText = $('#'+targetId).val();
            $('#'+targetId).val(currentText + completeCode);
            
      }
      $('#myModal').modal('hide');


}
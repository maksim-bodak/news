


////////////////////////////////////////////////////////////////////////////////////////
// Events                                                                             //
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// Constants                                                                          //
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// Variables                                                                          //
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// Constructor                                                                        //
////////////////////////////////////////////////////////////////////////////////////////
jQuery(document).ready(function () {
  for (var i = 0; i < _selectedIds.length; i++) {
    var selectedId = _selectedIds[i];
    if (selectedId != "") {
      jQuery("form[name=adminForm] input[type=checkbox][name^=cid][value=" + selectedId + "]").prop("checked", true);
    }
  }
});

////////////////////////////////////////////////////////////////////////////////////////
// Public Methods                                                                     //
////////////////////////////////////////////////////////////////////////////////////////
function submitCheckedItems() {
  var shippingMethods = [];
  jQuery("form[name=adminForm] input[type=checkbox][name^=cid]:checked").each(function () {
      var jq_thisTr = jQuery(this).closest("tr");
      var shippingMethod = {};
      shippingMethod.id = jq_thisTr.attr("itemId");
      shippingMethod.name = jq_thisTr.attr("itemName");
      shippingMethods.push(shippingMethod);
  });
  window.parent[_callback](shippingMethods);
  window.parent.tb_remove();
}

////////////////////////////////////////////////////////////////////////////////////////
// Getters & Setters                                                                  //
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// Private Methods                                                                    //
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// Listeners                                                                          //
////////////////////////////////////////////////////////////////////////////////////////
function onBtnSelectClick(event, obj) {
  submitCheckedItems();
}

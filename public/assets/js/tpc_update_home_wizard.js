jQuery(document).ready(function ($) {

    $('#tpc_update_home').smartWizard({
        theme:'dots',
        cycleSteps: false,
        enableURLhash: false,
        justified:true,
        toolbarSettings: {
            showNextButton: false,
            showPreviousButton: false
        },
        anchorSettings: {
            anchorClickable: false,
            enableAllAnchors: false,
            markDoneStep: true, 
            markAllPreviousStepsAsDone: true, 
            removeDoneStepOnNavigateBack: false, 
            enableAnchorOnDoneStep: true 
        },
        keyboardSettings: {
            keyNavigation: true
        }
    });

});

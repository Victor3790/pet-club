jQuery(document).ready(function ($) {

    $('#tpc_reg_forms').smartWizard({
        theme:'dots',
        cycleSteps: false,
        enableURLhash: true,
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
        },
    });

});

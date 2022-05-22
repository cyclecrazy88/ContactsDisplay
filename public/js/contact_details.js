
// Handler - For Contacts Details Cards, including actions
//  such as comment 'setting' for card items. Card/comment
//  sets.
class Contact_Details{

    constructor(){
        //console.log("Contact Details...")
        this.setupEventListener()
    }
    // Setup the event triggers for user actions on the page.
    setupEventListener(){

        const numberEvent = new RegExp(/^([0-9]{1,})$/)
        const userCommentList =
            document.querySelectorAll("textarea.userComment")
        for (var count = 0 ; count < userCommentList.length; count++){
            const commentItem = userCommentList[count]
            if (commentItem instanceof HTMLTextAreaElement){
                commentItem.addEventListener("change", async (eventRef)=>{
                    const eventCode = eventRef.currentTarget.getAttribute("keyCode")
                    if (numberEvent.test(eventCode)){
                        const codeNum = parseInt(eventCode)

                        const textValue = eventRef.currentTarget.value
                        const updateToken =
                        document.querySelector("input[name=\"_token\"]").value
                        if (typeof textValue == "string"){
                            const updateItem = {
                                _token:updateToken,
                                comment:textValue,
                                code:codeNum
                            };
                            var itemList = new URLSearchParams(updateItem).toString()

                            // Add the comment for the update event on the page,
                            //  Setup the corresponding comment value for the corresponding
                            //  item in the key.
                            var requestData = await fetch("/addComment/",{
                                method:"POST",
                                body:itemList,
                                cache: 'no-cache',
                                headers:{
                                    'X-CSRF-TOKEN':updateToken,
                                }
                            })

                        }
                    }
                }
                )
            }
        }
    }
}

// Filter the select drop down items for the display on the page
class Filter_Values{
    constructor(){
        this.filter_options()
    }
    filter_options(){
        // Setup a change event - for when the item, selection value changes.
        document.querySelector("div.country > select").addEventListener("change",()=>{
            const selectedItem =
            document.querySelectorAll("div.country > select option")
                [document.querySelector("div.country > select").selectedIndex]
            if (selectedItem instanceof HTMLOptionElement){
                const filterCountry = selectedItem.getAttribute("country")

                const cardList = document.querySelectorAll("div.card_item")
                for (var count = 0; count < cardList.length ; count++){
                    const cardItem = cardList[count]
                    if (cardItem instanceof HTMLDivElement){
                        const country = cardItem.getAttribute("country")
                        // Remove both classes show/hide for the filter item.
                        cardItem.classList.remove("showItem")
                        cardItem.classList.remove("hideItem")
                        if (filterCountry == null){
                            cardItem.classList.add("showItem")
                        }
                        else if (filterCountry == country){
                            cardItem.classList.add("showItem")
                        }else{
                            cardItem.classList.add("hideItem")
                        }

                    }
                }


            }
        })

    }
}


document.addEventListener("DOMContentLoaded",function(){
    const contactDetails = new Contact_Details()
    const filterDetails = new Filter_Values();
})


class GetContactsData{
    constructor(){
        // Blank constructor -- Let the 'extends' do this getData action
    }
    async getData(){
        var requestData = await fetch("https://randomuser.me/api/")
        var data = await requestData.json();

        var dataList = Array()
        if (data instanceof Object &&
            data.results instanceof Array){
            for (var dataKey in data.results){
                var dataItem = data.results[dataKey]
                dataList.push({
                    email:dataItem.email,
                    phone:dataItem.phone,
                    mobile:dataItem.cell,
                    name:dataItem.name.first +" "+dataItem.name.last,
                    city:dataItem.location.city,
                    country:dataItem.location.country,
                    state:dataItem.location.state,
                    postcode:dataItem.location.postcode,
                    thumbnail:dataItem.picture.medium
                })
            }
        }
        return dataList;
    }
}
class DisplayContactList extends GetContactsData{
    constructor(){
        super()
        this.loadItems()
        this.sortList()
    }
    async loadItems(){
        // Loaded item listing
        this.loadList = Array()
        for (this.itemCount = 0; this.itemCount < 2; this.itemCount++){
            await this.loadData();
        }
        document.querySelector("span.contentCount").innerText = this.itemCount;

        this.setupEventHandlers()
    }
    // Setup the event handlers for the action - open/close etc.
    setupEventHandlers(){
        function updateItem(eventData){
            eventData.currentTarget.className =
            eventData.currentTarget.className.indexOf("itemActive")==-1?
                "contactContainer itemActive":"contactContainer itemHidden";
        }

        var clientItems =
        document.querySelectorAll("div.contactContainer")

        for (var clientItemKey = 0;
                clientItemKey < clientItems.length;
                clientItemKey++){
            clientItems[clientItemKey].addEventListener("click",updateItem)
        }
    }

    // Sort the item list
    sortList(){
        var thisRef = this
        async function changeEvent(eventData){
            var columnSearchKey =
                document.querySelector("div.orderByItem > select")
                [eventData.currentTarget.selectedIndex].value

            var regexNumber = new RegExp(/^([0-9\ -()]{1,})/)

            // Sort by the loaded item list
            if (thisRef.loadList instanceof Array){
                var sortList =
                thisRef.loadList.sort(function(input1, input2){
                    var key1 = input1[columnSearchKey]
                    var key2 = input2[columnSearchKey]


                    if (regexNumber.test(key1) &&
                        regexNumber.test(key2)){
                            var filterKey1 = key1.replaceAll(" ","").
                                replaceAll("-","").
                                replaceAll(")","").
                                replaceAll("(","")
                            var filterKey2 = key2.replaceAll(" ","").
                                replaceAll("-","").
                                replaceAll(")","").
                                replaceAll("(","")

                            if (parseInt(filterKey1) > parseInt(filterKey2)){
                                return 1;
                            }
                            else{
                                return -1;
                            }
                    }else{
                        if (key1 > key2){
                            return 1;
                        }
                        else{
                            return -1;
                        }
                    }



                })

                while (document.querySelector("div.contactItem > div") != null){
                    document.querySelector("div.contactItem > div").remove()
                }
                await thisRef.loadData(sortList)
                thisRef.setupEventHandlers();
            }
        }

        document.querySelector("div.orderByItem > select").
            addEventListener("change",changeEvent)
        //document.addEventListener

    }

    async loadData(inputData){
        var data = []; // Set as an array - so if anything can be iterated to nothing
        if (inputData instanceof Array){
            data = inputData
        }else{
            data = await this.getData()
        }

        // Flag for initial loop around
        var initialSet = false;
        for (var dataKey in data){
            var dataItem = data[dataKey]

            // Show/Hide based on the count - initial config.
            var showItem = "itemHidden";

            // Cache the loaded item - can be reused for
            //  item sorting. -- Just do this when loading the
            //  data with getData, as otherwise using the
            //  cached copy
            if (inputData == undefined){
                this.loadList.push(dataItem)
                 // Show/Hide input items.
                 if ( this.itemCount == 0 ){
                    showItem = "itemActive";
                }
            }else{
                if (!initialSet){
                    showItem = "itemActive";
                }
            }
            initialSet = true




            // Create the element, then set the innerText
            //  for each item.
            var contactItem = document.createElement("div")
            contactItem.className ="contactContainer "+showItem
            contactItem.innerHTML =
            "<div class=\"heading\">"+
            "<img class=\"thumbnail\"/>"+
            "<div>"+
            "<div class=\"name\"></div>"+
            "<div class=\"mobile\"></div></div></div>"+
            "<div class=\"bodyLeft\">"+
            "<div class=\"city\"></div>"+
            "<div class=\"country\"></div>"+
            "<div class=\"state\"></div>"+
            "<div class=\"postcode\"></div>"+
            "</div>"+
            "<div class=\"bodyRight\">"+
            "<div class=\"phone\"></div>"+
            "<div class=\"email\"></div>"+
            "</div>";
            // Update the element properties
            contactItem.querySelector("img.thumbnail").
                setAttribute("src",dataItem.thumbnail);
            contactItem.querySelector("div.name").innerText = dataItem.name;
            contactItem.querySelector("div.phone").innerText = dataItem.phone;
            contactItem.querySelector("div.city").innerText = dataItem.city;
            contactItem.querySelector("div.country").innerText = dataItem.country;
            contactItem.querySelector("div.state").innerText = dataItem.state;
            contactItem.querySelector("div.postcode").innerText = dataItem.postcode;
            contactItem.querySelector("div.email").innerText = dataItem.email;
            contactItem.querySelector("div.mobile").innerText = dataItem.mobile;


            document.querySelector("div.contactItem").appendChild(contactItem)

        }


    }
}




document.addEventListener("DOMContentLoaded",()=>{
    new DisplayContactList();

})

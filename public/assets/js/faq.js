let questions = [
    {
        "id": 1,
        "Question": "How long will it take for my order to arrive? ",
        "Answer": "Due to the current circumstances of covid-19, deliveries may be slightly delayed depending on the local delivery network in your region. We hope that you lend your patience to the logistic teams no matter where they are, who are supplying us with our daily essentials and keeping goods flow through our communities.  \n" +
            "\n" +
            "<br>" +
            "<br>" +
            "All standard orders will be shipped four to five business days of confirmation from our team that they have received your order. If your order includes an item that we indicated will be shipped at a later date, we will only ship the entire order out together once the item arrives." +
            "<br>" +
            "<br>" +
            "*Local Express Shipping \n" +
            "<br>" +
            "If you are located in Singapore and need to expedite your package, do email us first at hola@duxton.com. We’ll respond within 24 hours. \n" +
            "<br>" +
            "Currently, we do not ship on weekends and public holidays. ",
        "type": "shipping"
    },
    {
        "id": 2,
        "Question": "Will I receive customs/import duties?",
        "Answer": "Any customs or import duties are charged once the parcel reaches its destination country. You may be charged for handling fees and taxes as your order passes through customs. These charges must be paid by the recipient of the parcel. We are not responsible for any customs and import duty charges. <br>" +
            "<br>" +
            "<br>" +
            "Unfortunately, we have no control over these charges and are unable to tell you what the cost would be, since customs policies and import duties vary widely from country to country. We recommend contacting your local customs office for current charges before you order, so you are not surprised by charges you were not expecting. ",
        "type": "shipping"
    },
    {
        "id": 3,
        "Question": "How do I place a return or exchange?",
        "Answer": "It’s our goal to ensure you have the best possible experience with us, and so we offer returns valid for 30 days from the date of arrival. As such, you will be responsible for paying for your own shipping costs for returning your item. \n" +
            "<br>" +
            "<br>" +
            "To return your item, do email us at hola@duxton.com and mail it back to: \n" +
            "<br>" +
            "<br>" +
            "HEXASHOP.COM" +
            "<br>" +
            "<br>" +
            "1 Dai Co Viet St, Ha Noi, Viet Nam",
        "type": "shipping"
    },
    {
        "id": 4,
        "Question": "If 30 days have gone by since you’ve received the parcel, unfortunately, we can’t offer you a refund or exchange?",
        "Answer": "To be eligible for a return, your item must be unused and in the same condition that you received it. It must also be in the original packaging. Gift cards are non-returnable. Please note that shipping cost is not refunded.\n" +
            "<br>" +
            "<br>" +
            "If you are shipping an item over $75, you should consider using a trackable shipping service or purchasing shipping insurance so that your order travels safely us, as we cannot guarantee that we will receive your returned item. \n" +
            "<br>" +
            "<br>" +
            "Once your return is received and inspected, we will send you an email to notify you that we have received your returned item. If all is well with the returned item your refund will be processed, and a credit will automatically be applied to your credit card or original method of payment within 14 days. \n" +
            "<br>" +
            "<br>" +
            "If you haven’t received a refund yet, first check your bank account again. Then contact your credit card company, it may take some time before your refund is officially posted. Next, contact your bank. There is often some processing time before a refund is posted. If you’ve done all of this and you still have not received your refund yet, please contact us at hola@duxton.com. ",
        "type": "shipping"
    },
    {
        "id": 5,
        "Question": "Can I return or exchange an item I bought on sale?",
        "Answer": "Unfortunately, all items purchased during a sale or marked at a discounted rate cannot be exchanged or refunded. If you send them back to us for a return we will not be able to process a refund. If you have any questions about sizing, fit, or fabric, please reach out to our customer service before placing your order. "
    },
    {
        "id": 6,
        "Question": "I think I got the sizing wrong on my order, can I exchange it for a different size? ",
        "Answer": "We’re happy to send you the right size and do an exchange! Otherwise, we only replace items if they have arrived defective or damaged. If you need to exchange it for the same item in a different size, send us an email at hola@duxton.com before sending your item to: \n" +
            "<br>" +
            "<br>" +
            "DUXTON.COM \n" +
            "<br>" +
            "<br>" +
            "21 Yong Siak Singapore S168651",
        "type": "shipping"
    },
    {
        "id": 7,
        "Question":"How do I know which size fits me?",
        "Answer" : "Please click on the size guide that is on each product page. If you have any specific questions please feel to contact us at hola@duxton.com \n" +
            "<br>" +
            "<br>" ,
        "type": "sizing"
    },
    {
        "id": 8,
        "Question": "Everything on your site is billed in SGD? ",
        "Answer" : "Hi all. Everything on our site is billed in SGD. Thank you for your understanding. ",
        "type" : "currency-sgd"
    },
    {
        "id": 9,
        "Question": "How do I care for my HEXASHOP items? ",
        "Answer" : "We select and test fabrics to ensure that all garments may be machine-washed easily. That said, please follow the care instructions of each garment.. When in doubt, hand wash always wins. And if you want to use the washer, please place them with similar colors. \n" +
            "<br>" +
            "<br>" +
            "Our three rules to go by: \n" +
            "<br>" +
            "<br>" +
            "Hand wash — For delicate items stick to spot cleaning only. Otherwise, handwash cold with a mild detergent to maintain the colour and feel. Leave to soak for a few minutes, then treat with a fabric conditioner in the final rinse to keep its feel. Rinse well in cold water and avoid wringing, keep to line drying your garment inside-out, away from the sunlight. \n" +
            "<br>" +
            "<br>" +
            "Wash cold — Wash clothes in cold water, as opposed to warm or hot, and always wait until you have a full load. Hang or lay flat to dry. \n" +
            "<br>" +
            "<br>" +
            "Steaming and ironing — For everything cupro, turn your garment inside out and iron it on the lowest setting. Spray some water to help straighten out the wrinkles. For everything else, turn your garment inside out and iron it on a medium heat setting. \n" +
            "<br>" +
            "<br>" +
            "Still got questions? Want to say hi?\n" +
            "<br>" +
            "<br>" +
            "Email us: hola@hexashop.com \n" +
            "<br>" +
            "<br>" +
            "Whatsapp us:+6584714493",
        "type" : "care"
    },
];

/*
This function display HTML elements display Question and Answer from questions array
 */
function displayFAQ(arr) {
    let collapseItem = '';
    for (let i = 0; i < arr.length; i++) {
        collapseItem += `<div class="card-header w-100" id="question_${arr[i].id}">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#answer_${arr[i].id}" aria-expanded="true" aria-controls="answer_${arr[i].id}">
                ${arr[i].Question}
        </button>
      </h5>
    </div>
    <div id="answer_${arr[i].id}" class="collapse" aria-labelledby="question_${arr[i].id}" data-parent="#accordion">
      <div class="card-body ">
      ${arr[i].Answer}
      <img src="${arr[i].image}" alt="">
      </div>
    </div>
  </div>`
    }
    document.querySelector("#accordion").innerHTML = collapseItem;
}

/*
Create a function display the Question & Answer which match with the search value
 */
const searchInput = document.querySelector('#search-input');
const searchValue = searchInput.value;
searchInput.addEventListener('input', function (e) {
    let value = e.target.value.toLowerCase();
    displayFAQ(showResult(questions, value));
});

function showResult(arr, value) {
    let result = [];
    questions.forEach((item) => {
        if (item.Question.toLowerCase().includes(value) ||
            item.Answer.toLowerCase().includes(value)) {
            result.push(item);
        }
    })
    return result;
}

displayFAQ(questions);

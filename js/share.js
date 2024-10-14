function toggleShareButtons() {
    const shareButtons = document.getElementById("share-buttons");
    if (shareButtons.style.display === "none") {
        shareButtons.style.display = "flex"; // Use flexbox for layout
    } else {
        shareButtons.style.display = "none";
    }
}

function shareOnFacebook(productId) {
    const url = `https://www.facebook.com/sharer/sharer.php?u=https://https://localhost/phptraining/projects/foxclore/post.php?id=${productId}`;
    window.open(url, '_blank');
}

function shareOnWhatsApp(productName, productId) {
    const url = `https://www.amazon.in/Sony-CFI-2008A01X-PlayStation%C2%AE5-Console-slim/dp/B0CY5HVDS2/ref=sr_1_2?crid=WRPCHH7L2AGL&dib=eyJ2IjoiMSJ9.LFVt-P4VfYSI0tw5J_cegSK92whhtXrjDDzVMLUNuoX8xZ-5Hv9V4BOoUXWCB2ds1ZtwBaJXd7KKWSpTMoxLbtEy1i3Q9OIz-TRue_iFs9NS9ZEVg90jHurAIx_QvauwMS7tfZqChE1okRa-hRTAou4n_2SR20RNUrihGQSDVknTRzx3JAQmPWrs1NwPp9OovsBrtwC1sTxhFSJTDtmXZAMIwo1-UeSJFmS_qSxkbQE.WXn8coyvQBkTZddVCz3i4XSY5uWLoyalAMQ6bwaH8iE&dib_tag=se&keywords=ps5&qid=1728885273&sprefix=ps%2Caps%2C209&sr=8-2?id=${productId}`;
    const text = `Check out this article: ${productName} - ${url}`;
    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text)}`;
    window.open(whatsappUrl, '_blank');
}

function shareOnTwitter(productName, productId) {
    const url = `https://www.amazon.in/Sony-CFI-2008A01X-PlayStation%C2%AE5-Console-slim/dp/B0CY5HVDS2/ref=sr_1_2?crid=WRPCHH7L2AGL&dib=eyJ2IjoiMSJ9.LFVt-P4VfYSI0tw5J_cegSK92whhtXrjDDzVMLUNuoX8xZ-5Hv9V4BOoUXWCB2ds1ZtwBaJXd7KKWSpTMoxLbtEy1i3Q9OIz-TRue_iFs9NS9ZEVg90jHurAIx_QvauwMS7tfZqChE1okRa-hRTAou4n_2SR20RNUrihGQSDVknTRzx3JAQmPWrs1NwPp9OovsBrtwC1sTxhFSJTDtmXZAMIwo1-UeSJFmS_qSxkbQE.WXn8coyvQBkTZddVCz3i4XSY5uWLoyalAMQ6bwaH8iE&dib_tag=se&keywords=ps5&qid=1728885273&sprefix=ps%2Caps%2C209&sr=8-2?id=${productId}`;
    const text = `Check out this article: ${productName} - ${url}`;
    const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}`;
    window.open(twitterUrl, '_blank');
}

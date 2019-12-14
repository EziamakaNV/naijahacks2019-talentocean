const express = require('express');
const bodyparser = require('body-parser');
const optionsAfricaTalking = {
    apiKey: 'd1a9cb56794bc2ee97ed62fcf43aa9624d1e71a0e2e30be7808268bafc6068c7',   
    username: 'sandbox',      
};
const AfricasTalking = require('africastalking')(optionsAfricaTalking);
const PORT = process.env.PORT || 5000;
const LINODE_API_KEY = process.env.LINODE_API_KEY || '66b533e4ed617ed9308394a3028b1c046a6de02aa10647a9290808befd2d72b8';
require('dotenv').config();

const request = require('request');
const optionsAddCard = { 
method: 'POST',
url: 'https://api.linode.com/v4/account/credit-card',
headers: 
 { 
   'Content-Type': 'application/json',
   Authorization: `Bearer ${LINODE_API_KEY}` },
body: 
 { card_number: '4111111111111111',
   expiry_month: 12,
   expiry_year: 2020 },
json: true

};
const optionsLinodeInstance = {
    method: 'GET',
    url: 'https://api.linode.com/v4/linode/instances',
    qs: {page: '1', page_size: '25'},
    headers: 
     { 
        'Content-Type': 'application/json',
       Authorization: `Bearer ${LINODE_API_KEY}` }
}
const optionsResizeLinodeInstance = {
method: 'POST',
url: 'https://api.linode.com/v4/linode/instances/{}/resize',
headers: 
 { 
   'Content-Type': 'application/json',
   Authorization: `Bearer ${LINODE_API_KEY}` },
body: 
 { 
     "type": ""

}

}
const optionsRebootLinodeInstance = {
method: 'POST',
url: 'https://api.linode.com/v4/linode/instances/{}/reboot',
headers: 
 { 
   'Content-Type': 'application/json',
   Authorization: `Bearer ${LINODE_API_KEY}` },
body: 
 { 
     "config_id": 0

}
}

function addCard(){
    let promise = new Promise(function(resolve,reject){

        request(optionsAddCard,function(err,response,body){
            if (err) reject(err);
            if(response.statusCode === 200){
            resolve('Card Added Successfully'); 
            }
            else{
                resolve(`Unsucessful: ${body.errors[0].reason}`);
            } 

           });
    });

    return promise;
}

function linodeInstance(){
let promise = new Promise(function(resolve,reject){

        request(optionsLinodeInstance,function(err,response,body){
            if (err) reject(err);

            if(response.statusCode === 200){
            //body received is in JSON string format
            //Used JSON.parse() to convert response in javascript object
            let bod = JSON.parse(body);

            resolve(`Label: ${bod.data[0].label}\n
            Image: ${bod.data[0].image}\n
            Status: ${bod.data[0].status}\n
            `); 

            }

            else{

                reject(`Unsucessful: ${bod.errors[0].reason}`);
            } 

           });
    });

    return promise;
}

function resizeLinodeInstance(){
    let promise = new Promise(function(resolve,reject){

        request(optionsResizeLinodeInstance,function(err,response,body){
            if (err) reject(err);

            if(response.statusCode === 200){
           
            
            resolve(`Resize Started`); 

            }

            else{

                reject(`Unsucessful: ${body.errors[0].reason}`);
            } 

           });
    });

    return promise;
}

function rebootLinodeInstance(){
    let promise = new Promise(function(resolve,reject){

        request(optionsRebootLinodeInstance,function(err,response,body){
            if (err) reject(err);

            if(response.statusCode === 200){
           
            
            resolve(`Reboot Started`); 

            }

            else{

                reject(`Unsucessful: ${body.errors[0].reason}`);
            } 

           });
    });

    return promise;
}

const app = express();

app.use(bodyparser.json());
//Need to parse for post request
app.post('/', new AfricasTalking.USSD((params, next) => {
    let endSession = false;
    let message = '';
    
    
    if (params.text === '') {
        message = "Talent Ocean Monitoring and Metrics \n";
        message += "1: Add Card \n";
        message += "2: Determine Linode Instance \n";
        message += "3: Scale-up Linode Instance \n";
        message += "4: Reboot Linode Instance"
        next({
            response: message, 
            endSession: endSession
        });

    } else if (params.text === '1') {
       addCard().then(function(result){
           message = result;
           endSession= true;

        next({
            response: message, 
            endSession: endSession
        });

       }, function(error){
        next({
            response: error, 
            endSession: endSession
        });
       });

    } else if (params.text === '2') {
        linodeInstance().then(function(result){
         next({
             response: result, 
             endSession: true
         });
 
        }, function(error){
         next({
             response: error, 
             endSession: true
         });
        });

    } else if (params.text === '3'){
        resizeLinodeInstance().then(function(result){
            next({
                response: result, 
                endSession: true
            });
    
           }, function(error){
            next({
                response: error, 
                endSession: true
            });
           });

    } else if (params.text === '4'){
        rebootLinodeInstance().then(function(result){
            next({
                response: result, 
                endSession: true
            });
    
           }, function(error){
            next({
                response: error, 
                endSession: true
            });
           });

    }
     else {
        message = "Invalid option";
        endSession = true;
    }
   
   
}));

app.listen(PORT, () => {
    console.log(`App listening on PORT ${PORT}`);
});
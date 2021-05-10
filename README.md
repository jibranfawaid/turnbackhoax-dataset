## TURNBACKHOAX DATASET

***Here you can find the dataset from https://turnbackhoax.id***

***This dataset was obtained on 25th April 2021***

## Overview  
The dataset CSV files is comma separated file and have the following columns:

 - `label` - Unique identifider for each news
 - `Headline` - Title of the news article
 - `Body` - Content of the news article
 
##Scrapping Method    
 
Scripts are written in PHP.

Install all the libraries using composer and the following command
    
    composer install

 
There is two main function that has to be run

First one is 

    $script->copy_header_and_link();

This function run a request to https://turnbackhoax.id to get the header and the link of each news

We manually copy and paste them to excel file (can be seen in code/src/Scrapping Result (Heading and Link).xlsx)

After we got the link, we iterating them and send a request to get their content using this function


    $script->copy_content();

And again we manually copy them to excel

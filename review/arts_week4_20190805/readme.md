
阅读下文有感：
https://medium.com/@ageitgey/natural-language-processing-is-fun-9a0bff37854e

ref:  
https://explosion.ai/blog/parsing-english-in-python
https://explosion.ai/demos/displacy

本文讲述了自然语言的处理

# 计算机是否能读懂语言

计算机不能用人理解英文的方式去读懂英文，但通过nlp可以  
python lib如： spaCy, textacy, neuralcoref

# 从文本中提取含义是困难的
Doing anything complicated in machine learning usually means building a 
pipeline. The idea is to break up your problem into very small pieces and 
then use machine learning to solve each smaller piece separately. Then by 
chaining together several machine learning models that feed into each 
other, you can do very complicated things.

#  构建nlp pipeline

## Sentence Segmentation 句子拆分

* “London is the capital and most populous city of England and the United Kingdom.”
* “Standing on the River Thames in the south east of the island of Great Britain, London has been a major settlement for two millennia.”
* “It was founded by the Romans, who named it Londinium.”

## Word Tokenization  提取单词

“London”, “is”, “ the”, “capital”, “and”, “most”, “populous”, “city”, “of”,
 “England”, “and”, “the”, “United”, “Kingdom”, “.”
 
Tokenization is easy to do in English. We’ll just split apart words whenever 
there’s a space between them. And we’ll also treat punctuation marks as 
separate tokens since punctuation also has meaning.

## Predicting Parts of Speech for Each Token

Next, we’ll look at each token and try to guess its part of speech — whether 
it is a noun, a verb, an adjective and so on. Knowing the role of each word in 
the sentence will help us start to figure out what the sentence is talking about.

## Text Lemmatization

I had a pony.
I had two ponies.

## Identifying Stop Words

Next, we want to consider the importance of a each word in the sentence. 
English has a lot of filler words that appear very frequently like “and”, “the”, 
and “a”. When doing statistics on text, these words introduce a lot of noise 
since they appear way more frequently than other words. Some NLP 
pipelines will flag them as stop words —that is, words that you might want 
to filter out before doing any statistical analysis.

##  Dependency Parsing

* figure out how all the words in our sentence relate to each other
* goal--build a tree that assigns a single parent word to each word in the sentence

## Finding Noun Phrases

So far, we’ve treated every word in our sentence as a separate entity. But 
sometimes it makes more sense to group together the words that represent 
a single idea or thing. We can use the information from the dependency 
parse tree to automatically group together words that are all talking about the same thing.

## Named Entity Recognition (NER)

For example, “London”, “England” and “United Kingdom” represent physical places on a map.  
It would be nice to be able to detect that! With that information, we could automatically extract  
a list of real-world places mentioned in a document using NLP.

The goal of Named Entity Recognition, or NER, is to detect and label these nouns with the real-world 
concepts that they represent. 


## Coreference Resolution

English is full of pronouns — words like he, she, and it. These are shortcuts that we use instead of 
writing out names over and over in each sentence. Humans can keep track of what these words represent 
based on context. But our NLP model doesn’t know what pronouns mean because it only examines one 
sentence at a time.


# Coding the NLP Pipeline in Python

## Extracting Facts
```
import spacy
import textacy.extract

# Load the large English NLP model
nlp = spacy.load('en_core_web_lg')

# The text we want to examine
text = """London is the capital and most populous city of England and  the United Kingdom.  
Standing on the River Thames in the south east of the island of Great Britain, 
London has been a major settlement  for two millennia.  It was founded by the Romans, 
who named it Londinium.
"""

# Parse the document with spaCy
doc = nlp(text)

# Extract semi-structured statements
statements = textacy.extract.semistructured_statements(doc, "London")

# Print the results
print("Here are the things I know about London:")

for statement in statements:
    subject, verb, fact = statement
    print(f" - {fact}")
```

## Extract frequently-mentioned noun

```
import spacy
import textacy.extract

# Load the large English NLP model
nlp = spacy.load('en_core_web_lg')

# The text we want to examine
text = """London is [.. shortened for space ..]"""

# Parse the document with spaCy
doc = nlp(text)

# Extract noun chunks that appear
noun_chunks = textacy.extract.noun_chunks(doc, min_freq=3)

# Convert noun chunks to lowercase strings
noun_chunks = map(str, noun_chunks)
noun_chunks = map(str.lower, noun_chunks)

# Print out any nouns that are at least 2 words long
for noun_chunk in set(noun_chunks):
    if len(noun_chunk.split(" ")) > 1:
        print(noun_chunk)
```

## extranct entity (type)
```
import spacy

# Load the large English NLP model
nlp = spacy.load('en_core_web_lg')

# The text we want to examine
text = """London is the capital and most populous city of England and 
the United Kingdom.  Standing on the River Thames in the south east 
of the island of Great Britain, London has been a major settlement 
for two millennia. It was founded by the Romans, who named it Londinium.
"""

# Parse the text with spaCy. This runs the entire pipeline.
doc = nlp(text)

# 'doc' now contains a parsed version of text. We can use it to do anything we want!
# For example, this will print out all the named entities that were detected:
for entity in doc.ents:
    print(f"{entity.text} ({entity.label_})")
```


##  过滤名词
```
import spacy

# Load the large English NLP model
nlp = spacy.load('en_core_web_lg')

# Replace a token with "REDACTED" if it is a name
def replace_name_with_placeholder(token):
    if token.ent_iob != 0 and token.ent_type_ == "PERSON":
        return "[REDACTED] "
    else:
        return token.string

# Loop through all the entities in a document and check if they are names
def scrub(text):
    doc = nlp(text)
    for ent in doc.ents:
        ent.merge()
    tokens = map(replace_name_with_placeholder, doc)
    return "".join(tokens)

s = """
In 1950, Alan Turing published his famous article "Computing Machinery and Intelligence". In 1957, Noam Chomsky’s 
Syntactic Structures revolutionized Linguistics with 'universal grammar', a rule based system of syntactic structures.
"""

print(scrub(s))
```

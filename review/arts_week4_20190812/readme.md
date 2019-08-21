阅读下文有感：

https://medium.com/analytics-vidhya/building-a-simple-chatbot-in-python-using-nltk-7c8c8215ac6e

由Duolingo(https://www.duolingo.com/) 一个流行的语言学习app引入聊天机器人的话题

Duolingo通过聊天机器人解决了学以致用的问题。

## 什么是聊天机器人（chatbot）

Siri, Alexa, Google Assistant 等等都是聊天机器人的实际例子

公司通过机器人来满足客户在特定场景下的任务。这些场景可能有

*  获取航班信息
*  连接客户和他们的财产
*  客户支持

机器人的历史要追溯到1966年。由 Weizenbaum 创造的名称为 ELIZA 的程序。
这个程序仅有200行代码（http://psych.fullerton.edu/mbirnbaum/psych101/Eliza.htm?utm_source=ubisend.com&utm_medium=blog-link&utm_campaign=ubisend）。


## 聊天机器人是怎么工作的

1. 基于规则--基于某些规则来训练机器人。这些规则从简单到复杂。机器人能掌握简单的查询  
但对于复杂的问题可能会失败

2.  自学习（Self-learning ）。通过机器学习来实现

* 基于检索的模型（ retrieval-based models），聊天机器人能通过启发式算法从预先定义好的回复中  
选取一个回复。

* Generative（有生产力的） 不仅仅是基于一组回答标本，而是能够自行回答


## 构建一个机器人

* NLP 
The field of study that focuses on the interactions between human language 
and computers is called Natural Language Processing, or NLP for short. 
It sits at the intersection of computer science, artificial intelligence(人工智能), 
and computational linguistics[Wikipedia].NLP is a way for computers to 
analyze, understand, and derive meaning from human language in a smart 
and useful way. By utilizing NLP, developers can organize and structure 
knowledge to perform tasks such as automatic summarization(自动摘要), translation（翻译）, 
named entity recognition（实体识别）, relationship extraction（关联提取）, sentiment analysis(感情分析), 
speech recognition（语音识别）, and topic segmentation（主题分割）.


* NLTK (Natural Language Toolkit)
python用来处理人类语言数据的程序库
Natural Language Processing with Python（http://www.nltk.org/book/）--学习NLTK的绝佳书籍

* 下载NLTK pip install nltk;  import nltk

install nltk pkg: nltk.download()

*  使用NLTK来进行文本预处理

基本的文本预处理包括：
1） 将整个文本转成大写（小写）  
2） 词语切分（Tokenization）。

NLTK 数据包包含 针对英语的 Punkt tokenizer的预处理数据包
1） 去除噪音
2） 去除 Stop words(个人理解是不重要的一些)
3)  Stemming (不同格式的词会背认作一个，比如Stems, Stemming, Stemmed, and Stemtization会被认为是stem)
4)  词形还原(Lemmatization)，比如running, ran---->都是基于run的。  

* 单词包（Bag of Words）
经过与处理阶段，我们能够将文本转化成有意义的向量（数组）对象。
单词包包含两层含义：
1） 已知单词的词汇表
2） 对已存在单词的衡量手段  
之所以成为单词“包“，是因为，我们更关系的是单词是否在单词中存在，而不是它在文本的哪儿存在。
通过比较两篇文档中的单词包，我们就可以比较这两篇文档的内容相似性

* TF-IDF  
TF(Term Frequency) = (Number of times term t appears in a document)/(Number of terms in the document)  
IDF(Inverse Document Frequency) = 1+log(N/n), where, N is the number of documents and n is the number of documents a term t has appeared in. 
Cosine Similarity (d1, d2) =  Dot product(d1, d2) / ||d1|| * ||d2||  

* 自行构建chatbot
https://github.com/parulnith/Building-a-Simple-Chatbot-in-Python-using-NLTK/blob/master/chatbot.py  

1) 导入必要的库
```
import nltk
import numpy as np
import random
import string # to process standard python strings
```

2) Corpus(语料库) --比如维基百科的网页内容。
3) 读取数据
```
f=open('chatbot.txt','r',errors = 'ignore')
raw=f.read()
raw=raw.lower()# converts to lowercase
nltk.download('punkt') # first-time use only
nltk.download('wordnet') # first-time use only
sent_tokens = nltk.sent_tokenize(raw)# converts to list of sentences 
word_tokens = nltk.word_tokenize(raw)# converts to list of words
```
4) raw  文本预处理
```
lemmer = nltk.stem.WordNetLemmatizer()
#WordNet is a semantically-oriented dictionary of English included in NLTK.
def LemTokens(tokens):
    return [lemmer.lemmatize(token) for token in tokens]
remove_punct_dict = dict((ord(punct), None) for punct in string.punctuation)
def LemNormalize(text):
    return LemTokens(nltk.word_tokenize(text.lower().translate(remove_punct_dict)))
```
5) 关键字匹配  
```
GREETING_INPUTS = ("hello", "hi", "greetings", "sup", "what's up","hey",)
GREETING_RESPONSES = ["hi", "hey", "*nods*", "hi there", "hello", "I am glad! You are talking to me"]
def greeting(sentence):
 
    for word in sentence.split():
        if word.lower() in GREETING_INPUTS:
            return random.choice(GREETING_RESPONSES)
```
6) 产生回复 
```
def response(user_response):
    robo_response=''
    sent_tokens.append(user_response)
    TfidfVec = TfidfVectorizer(tokenizer=LemNormalize, stop_words='english')
    tfidf = TfidfVec.fit_transform(sent_tokens)
    vals = cosine_similarity(tfidf[-1], tfidf)
    idx=vals.argsort()[0][-2]
    flat = vals.flatten()
    flat.sort()
    req_tfidf = flat[-2]
    if(req_tfidf==0):
        robo_response=robo_response+"I am sorry! I don't understand you"
        return robo_response
    else:
        robo_response = robo_response+sent_tokens[idx]
        return robo_response
```
7) 主程序
```
flag=True
print("ROBO: My name is Robo. I will answer your queries about Chatbots. If you want to exit, type Bye!")
while(flag==True):
    user_response = input()
    user_response=user_response.lower()
    if(user_response!='bye'):
        if(user_response=='thanks' or user_response=='thank you' ):
            flag=False
            print("ROBO: You are welcome..")
        else:
            if(greeting(user_response)!=None):
                print("ROBO: "+greeting(user_response))
            else:
                print("ROBO: ",end="")
                print(response(user_response))
                sent_tokens.remove(user_response)
    else:
        flag=False
        print("ROBO: Bye! take care..")
```

# 总结

Though it is a very simple bot with hardly any cognitive skills, its a good 
way to get into NLP and get to know about chatbots.Though ‘ROBO’ 
responds to user input. It won’t fool your friends, and for a production 
system you’ll want to consider one of the existing bot platforms or 
frameworks, but this example should help you think through the design and 
challenge of creating a chatbot. Internet is flooded with resources and after 
reading this article I am sure , you will want to create a chatbot of your own. So happy tinkering!!


 






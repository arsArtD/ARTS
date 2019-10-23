

阅读下文有感：  

https://onezero.medium.com/how-spotifys-algorithm-knows-exactly-what-you-want-to-listen-to-4b6991462c5c

spotifys音乐的推荐算法

通过用户的日常操作，添加的歌单，听过的歌曲，所在区域

首页通过 aRT (“Bandits for Recommendations as Treatments”) 系统进行推荐.综合每个人的听歌习惯，互相推荐

除了根据历史听歌推荐外，也会推荐些新鲜的歌曲（没有听过的曲风）

The system can be boiled down to two concepts: Exploit and explore
Exploit----使用已知的信息，包括：听歌历史，略过的歌曲，创建的歌单，歌曲平台的中的社交属性（评论等），位置信息
explore----歌单和歌手类似于用户的品味但是还没听过的


Each label for shelves like “Jump back in” or “More of what you like” tells the user why those 
specific playlists are being recommended.  
更多喜欢就是以上推荐的结果

Success for BaRT is measured by whether you actually listen to the music on these shelves, and  
for how long. When you stream a song for more than 30 seconds, the algorithm tracks that as getting  
the recommendation right, according to the presentation. The longer you listen to the recommended  
playlist or set of songs, the better the recommendation is determined to be.  

Spotify’s sweet spot for understanding whether a person likes a song or not seems to be 30 seconds. 
In a 2015 interview with Quartz, Spotify product director Matthew Ogle, who has since left the company, 
mentioned that skipping before the 30-second mark is the equivalent of a thumbs down for the Discover Weekly playlist.
推荐的歌单中的歌曲被听的时间越长（30s以上），推荐效果越好

“Every word anyone utters on the internet about music goes through our systems that look for descriptive terms, 
noun phrases, and other text,” Whitman wrote.
任何人在互联网上说出的关于音乐的每一个词都要经过我们的系统来查找描述性术语、名词短语和其他文本，”惠特曼写道


Spotify intern Sander Dieleman, who worked at the company in 2014 and did some foundational work analyzing 
the auditory similarity of music, also explained the audio analysis algorithm in a personal blog post. 
The original problem was that new music was uploaded to Spotify every day, but there was no system to 
recommend music if it wasn’t by a previously popular artist. Collaborative filtering, or the method of 
recommending music liked by people with similar musical interests to each other, didn’t work when nobody 
knew the artist in the first place.
2014年，Spotify的实习生桑德·迪勒曼(Sander Dieleman)曾在该公司工作，做过一些分析音乐听觉相似性的基础性工作。最初的问题是，  
每天都有新音乐被上传到Spotify，但如果音乐不是由以前的流行歌手创作的，就没有系统来推荐音乐。协同过滤，也就是向彼此有相似音乐  
兴趣的人推荐自己喜欢的音乐的方法，在一开始就没有人认识这位艺术家的情况下是行不通的  


The solution was analyzing the audio itself and training an algorithm to learn to recognize different aspects 
of the music that might be desirable. Some experiments that Dieleman ran identified aspects of songs as concrete 
as distorted guitars, while others could recognize more abstract ideas like genre.  
解决方案是分析音频本身，并训练一个算法来学习识别音乐的不同方面，这可能是可取的。迪勒曼进行的一些实验将歌曲的某些方面识别为
具体的吉他变形，而另一些实验则识别出更抽象的概念，如流派

That system is now an important element of the Discover Weekly playlist, which is why you might see an artist 
being recommended that you’ve never heard of.
这个系统现在是每周发现播放列表的一个重要元素，这就是为什么你可能会看到一个你从未听说过的艺术家被推荐。

But algorithms can be tucked into all sorts of places on Spotify. While there are recommendation algorithms, 
like the ones that power the home screen and Discover Weekly, there are smaller tools that you’ve probably used 
but would never realize were the product of relatively cutting-edge A.I. research
但算法可以塞进Spotify上的任何地方。虽然有推荐算法，比如主屏幕和每周发现(Discover)的推荐算法，但也有更小的工具，你可能用过，
但永远不会意识到它们是相对前沿的人工智能研究的产物

Take for instance, automatic playlist continuation. This feature analyzes the songs in a certain playlist and 
tries to predict the music that should come next — as if the person who created it had just kept adding music. 
Spotify wanted new ways to think about how it should be building that feature, so it released a “Million Playlist Dataset” 
of user-generated Spotify playlists that could be used to understand the traits of what humans considered a good set of tracks. 
The company invited other A.I. researchers to try and help them solve the problem and present their solutions at a 2018 
industry conference. More than 100 academic and industry teams formed around the project, according to an analysis done 
by organizers after the competition. (We don’t know if the winners’ idea actually made it into Spotify’s app.)  
以自动播放列表延续为例。这一功能分析特定播放列表中的歌曲，并试图预测接下来会出现的音乐——就好像创建它的人一直在添加音乐一样。
Spotify想要用新的方式来思考它应该如何构建这个功能，所以它发布了一个用户生成的Spotify播放列表的“百万播放列表数据集”，可以用来
了解人类认为好的一组曲目的特征。该公司邀请其他人工智能研究人员尝试帮助他们解决这个问题，并在2018年的一个行业上展示他们的解决方案

Spotify researchers have also been working on ways to detect covers of songs on Spotify, which could play instead of the  
original version of the song that you actually wanted to hear. The resulting work is able to distinguish covers from the   
original track with high accuracy, especially instrumental covers and live performances. Jazz proved to be trickier, 
as there was typically more improvisation.  
Spotify的研究人员还在研究如何在Spotify上检测歌曲的封面，这样就可以播放你真正想听的歌曲的原始版本。最终的作品能够以较高的精度将封面
与原曲目区分开，尤其是器乐封面和现场演奏。爵士乐被证明是更棘手的，因为通常有更多的即兴表演

The team has also worked on aligning written lyrics to the moment in a song where the lyric is sung, which could not 
only help with the company’s Behind the Music feature that shows lyrics alongside popular songs, but also open up new 
opportunities for Spotify
该团队还致力于将歌词与歌词演唱的时刻结合起来，这不仅有助于公司在流行歌曲旁边显示歌词的音乐功能，还为Spotify开辟了新的机会

“Time-aligned lyrics can enrich the music listening experience by enabling karaoke, text-based song retrieval and 
intra-song navigation, and other applications,” Spotify computer scientists wrote earlier this year.
通过启用卡拉ok、基于文本的歌曲检索和歌曲内导航等应用程序，时间对齐歌词可以丰富音乐聆听体验，”Spotify的计算机科学家今年早些时候写道

On top of all the research going into the Spotify platform, the company is also researching its users. Spotify studied 
data from more than 16 million users, tracking their listening patterns from December 2016 to February 2018, including 
how many times someone streamed a specific artist or song per day and what U.S. state they were in, according to a study 
published April 2019.
除了Spotify平台上的所有研究之外，该公司还在研究它的用户。Spotify研究了超过1600万用户的数据，追踪他们从2016年12月到2018年2月的收听模式，
包括某人每天播放特定艺术家或歌曲的次数，以及他们在美国的州，根据2019年4月发布的一项研究

That data, coupled with users’ self-reported gender and age, allowed Spotify to study whether music taste changes after s
omeone has moved to a different state, as well as how age impacts the kind of music a person listens to.
这些数据，再加上用户自己报告的性别和年龄，让Spotify能够研究一个人搬到另一个州后，音乐品味是否会发生变化，以及年龄如何影响一个人听的音乐类型

The team intuited a move to another state in a tricky way: Based on location data, Spotify users who went to another state 
for two of the three major holidays during the selected data — Christmas 2016, Thanksgiving 2017, and Christmas 2017 — were 
guessed to have moved from that location to the place where they typically stream from
团队凭直觉就知道,搬到另一个国家以微妙的方式:基于位置数据,Spotify用户去另一个州的两个三大节日期间选择的数据,2016年圣诞节,感恩节,2017年和2017年
圣诞节——被猜到了从该位置搬到他们通常的地方流

By studying the musical tastes of people in each state, and then contrasting the group of people who have moved to those 
different overall trends, the Spotify team concluded that over a long period of time, location does factor into musical 
taste in some small way.
通过研究每个州的人的音乐品味，然后对比一组搬到这些不同总体趋势的人，Spotify团队得出结论，在很长一段时间内，地点确实在一定程度上影响了音乐品味

“Relocation does appear to shift individuals’ tastes marginally towards those of their new environment. The size of this  
effect, however, is small, and listeners’ tend to more strongly resemble their past rather than present environments,”  
they wrote.  
重新安置似乎确实使个人的口味略微向新环境的口味转变。然而，这种影响的规模很小，而且听众更倾向于与他们的过去而不是现在的环境更相似，”他们写道

By studying age, they also suggest the music that is popular from ages 10 to 20 is the music that people will predominantly 
listen to in the future, having shaped their “musical identity.”
通过对年龄的研究，他们还指出，从10岁到20岁流行的音乐是人们未来主要听的音乐，塑造了他们的“音乐身份”。

This all points to the vast amount of data that Spotify both has and needs to continue to collect on its users for its service 
to maintain its competitive edge. The 2015 presentation on Discover Weekly mentioned that Spotify logs one terabyte of user data 
per day.
这一切都表明，spotify拥有并需要继续收集用户的大量数据，以保持其竞争优势。2015年《发现周刊》的报告提到，spotify每天会记录1万亿字节的用户数据。

However, that data is clearly used in service of its customers. The company makes it clear in research that the success of 
all these algorithmic services is only possible because every action you make on the service is tracked and logged.
然而，这些数据显然是用来服务其客户的。该公司在研究中明确表示，所有这些算法服务的成功是可能的，因为您在服务上所做的每一个动作都被跟踪和记录。

And that might prove to be the secret sauce of music streaming. After all, Spotify has managed to thrive despite battling 
every tech giant, including music juggernaut Apple, which it’s beating by tens of millions more paying customers around 
the world.
这可能是音乐流媒体的秘密调料。毕竟，spotify尽管与包括音乐巨头苹果(apple)在内的所有科技巨头展开了较量，spotify还是成功地在全球范围内击败了
数千万付费用户。


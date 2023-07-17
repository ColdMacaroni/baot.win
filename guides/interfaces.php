<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Baot's Guides - Interfaces</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/styles.css" rel="stylesheet">

        <!-- Highlight code -->
        <link rel="stylesheet" href="/highlightjs/styles/base16/gruvbox-dark-hard.min.css" />
        <script src="/highlightjs/highlight.min.js"></script>
        <script>hljs.highlightAll();</script>
    </head>
    <body>
        <?php require $_SERVER["DOCUMENT_ROOT"] . "/header.php"; ?>
        <main>
          <h1 id="interfaces-what-in-the-world.">Interfaces, what in the world.</h1>
          <p>
            If you don't like my styling or would simply prefer a plain html version, <a href="plain/interfaces.html">you can find one here.</a>
          </p>
          <p>
            This is a guide about interfaces in (unfortunately) java for COMP103. If there
            is anything that isn’t clear, confused you more, or just needs more
            clarification please feel free to ping me on the COMP server or send me a DM.
            I’ll update the page as needed.
          </p>
          <p>
            So what are interfaces and what are they used for? The short answer is that
            they are a way of ensuring consistent methods between different classes
            without worrying about the implementation. If this didn’t clear anything up,
            don’t worry- there’s a lot of text left.
          </p>
          <p>
            I’ll also be referring to <code>ecs100</code> instead of standard java stuff.
            Like <code>UI.println</code> instead of
            <code>System.out.println</code> because it’s less verbose and also what most
            are familiar with.
          </p>
          <p>
            Also, this page uses JavaScript! Before you click away, it’s
            <a href="https://highlightjs.org">highlightjs</a> so that the code blocks have
            syntax highlighting :).
          </p>
          <p>
            <a href="/guides/samples/Interfaces.java"
              >You can find the final code for this guide here.</a
            >
          </p>
          <h2 id="terms">Terms</h2>
          <h3 id="classes-and-objects">Classes and objects</h3>
          <p>
            To start with, we need to look at classes (and objects). Interfaces in java
            are basically worthless without them. This isn’t meant to be a full
            introduction to classes, it’s just to set the stage.
          </p>
          <p>
            So- uh- what’s the difference between an object and a class? I’ll clarify
            because I’ll use that throughout the guide.
          </p>
          <p>
            You might see on the interwebs classes being described as the blueprint for
            objects, and objects being things built from those blueprints. Here’s a more
            practical example.
          </p>
          <p>
            A class is… the code that starts with <code>class Name {</code>. So the
            following is a class:
          </p>
          <div class="sourceCode" id="cb1">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb1-1"><a href="#cb1-1" aria-hidden="true" tabindex="-1"></a><span class="kw">class</span> Thing <span class="op">{</span></span>
<span id="cb1-2"><a href="#cb1-2" aria-hidden="true" tabindex="-1"></a>    <span class="kw">public</span> <span class="dt">int</span> field<span class="op">;</span></span>
<span id="cb1-3"><a href="#cb1-3" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb1-4"><a href="#cb1-4" aria-hidden="true" tabindex="-1"></a>    <span class="fu">Thing</span><span class="op">(</span><span class="dt">int</span> num<span class="op">)</span> <span class="op">{</span></span>
<span id="cb1-5"><a href="#cb1-5" aria-hidden="true" tabindex="-1"></a>        field <span class="op">=</span> num<span class="op">;</span></span>
<span id="cb1-6"><a href="#cb1-6" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb1-7"><a href="#cb1-7" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb1-8"><a href="#cb1-8" aria-hidden="true" tabindex="-1"></a>    <span class="kw">public</span> <span class="dt">int</span> <span class="fu">method</span><span class="op">(</span><span class="dt">int</span> argument<span class="op">)</span> <span class="op">{</span></span>
<span id="cb1-9"><a href="#cb1-9" aria-hidden="true" tabindex="-1"></a>        <span class="cf">return</span> field <span class="op">+</span> argument<span class="op">;</span></span>
<span id="cb1-10"><a href="#cb1-10" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb1-11"><a href="#cb1-11" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>And when I do:</p>
          <div class="sourceCode" id="cb2">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb2-1"><a href="#cb2-1" aria-hidden="true" tabindex="-1"></a>Thing thingName <span class="op">=</span> <span class="kw">new</span> <span class="fu">Thing</span><span class="op">(</span><span class="dv">57</span><span class="op">);</span></span></code></pre>
          </div>
          <p>
            What is created by <code>new Thing</code> and then stored into
            <code>thingName</code> is an object. The creation of an object is also called
            instantiation. (You may also see objects referred to as instances of class,
            but I won’t be saying that here to avoid confusion)
          </p>
          <h3 id="method-signatures">Method signatures</h3>
          <p>
            This is another term I’ll be referring to. It’s basically just the name of the
            method, with the types and arguments.
          </p>
          <p>So if I have a method that looks like:</p>
          <div class="sourceCode" id="cb3">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb3-1"><a href="#cb3-1" aria-hidden="true" tabindex="-1"></a><span class="dt">void</span> <span class="fu">coolStuff</span><span class="op">(</span><span class="dt">int</span> epicNumber<span class="op">)</span> <span class="op">{</span></span>
<span id="cb3-2"><a href="#cb3-2" aria-hidden="true" tabindex="-1"></a>    UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;Your number is &quot;</span> <span class="op">+</span> epicNumber<span class="op">);</span></span>
<span id="cb3-3"><a href="#cb3-3" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
</div>
<p>The method signature would be this bit:</p>
<div class="sourceCode" id="cb4">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb4-1"><a href="#cb4-1" aria-hidden="true" tabindex="-1"></a><span class="dt">void</span> <span class="fu">coolStuff</span><span class="op">(</span><span class="dt">int</span> epicNumber<span class="op">)</span></span></code></pre>
          </div>
          <p>That’s all! Here’s another example. For this method:</p>
          <div class="sourceCode" id="cb5">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb5-1"><a href="#cb5-1" aria-hidden="true" tabindex="-1"></a><span class="bu">String</span> <span class="fu">moreCoolStuff</span><span class="op">()</span> <span class="op">{</span></span>
<span id="cb5-2"><a href="#cb5-2" aria-hidden="true" tabindex="-1"></a>    <span class="cf">return</span> <span class="st">&quot;Cool stuff&quot;</span><span class="op">;</span></span>
<span id="cb5-3"><a href="#cb5-3" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
</div>
<p>The signature would be:</p>
<div class="sourceCode" id="cb6">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb6-1"><a href="#cb6-1" aria-hidden="true" tabindex="-1"></a><span class="bu">String</span> <span class="fu">moreCoolStuff</span><span class="op">()</span></span></code></pre>
          </div>
          <h2 id="how-do-you-define-an-interface">How do you define an interface?</h2>
          <p>Let’s get right into it. Here’s how you make one:</p>
          <div class="sourceCode" id="cb7">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb7-1"><a href="#cb7-1" aria-hidden="true" tabindex="-1"></a><span class="kw">interface</span> NameHere <span class="op">{</span></span>
<span id="cb7-2"><a href="#cb7-2" aria-hidden="true" tabindex="-1"></a>    <span class="dt">void</span> <span class="fu">someMethod</span><span class="op">(</span><span class="dt">int</span> arg<span class="op">);</span></span>
<span id="cb7-3"><a href="#cb7-3" aria-hidden="true" tabindex="-1"></a>    <span class="dt">int</span> <span class="fu">otherMethod</span><span class="op">();</span></span>
<span id="cb7-4"><a href="#cb7-4" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>
            It’s similar to how you define a class, except that you use the keyword
            <code>interface</code> instead. The key difference is that the methods are
            just signatures! They have nothing in between <code>{}</code>. They don’t even
            have the curly brackets!
          </p>
          <p>
            That’s all an interface is. It’s just a named thing with a list of methods.
            Pretty funky aye?
          </p>
          <h2 id="but-like-how-do-you-use-them">But like, how do you use them?</h2>
          <p>
            Let’s define a simple interface to do stuff with. I’ll call it
            <code>Talk</code> and list a couple methods. You might have some questions as
            to <em>why</em> use interfaces, but just bear with me.
          </p>
          <div class="sourceCode" id="cb8">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb8-1"><a href="#cb8-1" aria-hidden="true" tabindex="-1"></a><span class="kw">interface</span> Talk <span class="op">{</span></span>
<span id="cb8-2"><a href="#cb8-2" aria-hidden="true" tabindex="-1"></a>    <span class="dt">void</span> <span class="fu">speak</span><span class="op">(</span><span class="bu">String</span> message<span class="op">);</span></span>
<span id="cb8-3"><a href="#cb8-3" aria-hidden="true" tabindex="-1"></a>    <span class="dt">void</span> <span class="fu">yell</span><span class="op">();</span></span>
<span id="cb8-4"><a href="#cb8-4" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>Okay, very cool, we’ve got an interface. What now…</p>
          <p>
            Let’s say you now want to create a <code>Talk</code> variable called
            <code>speaker</code>. You might try to do something like this:
          </p>
          <div class="sourceCode" id="cb9">
            <pre
              class="sourceCode java"
            ><code class="sourceCode java"><span id="cb9-1"><a href="#cb9-1" aria-hidden="true" tabindex="-1"></a>Talk speaker <span class="op">=</span> <span class="kw">new</span> <span class="fu">Talk</span><span class="op">();</span></span></code></pre>
          </div>
          <p>
            However, this will <strong>not</strong> compile! You will likely see a message
            similar to this:
          </p>
          <pre class="plaintext"><code>Main.java:3: error: Talk is abstract; cannot be instantiated
    Talk speaker = new Talk();
                   ^
1 error</code></pre>
          <p>
            What does this even mean? Well, we can see that the error is where we tried to
            create a <code>new Talk()</code>. It did not complain about us defining a
            variable with the type <code>Talk</code>, so that’s okay. The important bit of
            the error is where it says “Talk is abstract”.
          </p>
          <p>
            In java (and many other languages, for example: C++), something being abstract
            basically means that it doesn’t have an implementation. In other words, it’ll
            have a name, but no actual code describing what it actually does! If this
            sounds confusing, here’s a little example.
          </p>
          <p>A normal method might look like this:</p>
          <div class="sourceCode" id="cb11">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb11-1"><a href="#cb11-1" aria-hidden="true" tabindex="-1"></a><span class="dt">void</span> <span class="fu">say</span><span class="op">(</span><span class="bu">String</span> message<span class="op">)</span>  <span class="co">/* &lt;-- This is the signature */</span></span>
<span id="cb11-2"><a href="#cb11-2" aria-hidden="true" tabindex="-1"></a><span class="op">{</span>                                    <span class="co">/* &lt;--                             */</span></span>
<span id="cb11-3"><a href="#cb11-3" aria-hidden="true" tabindex="-1"></a>    UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;I say: &quot;</span> <span class="op">+</span> message<span class="op">);</span> <span class="co">/* &lt;--  This is the implementation */</span></span>
<span id="cb11-4"><a href="#cb11-4" aria-hidden="true" tabindex="-1"></a><span class="op">}</span>                                    <span class="co">/* &lt;--                             */</span></span></code></pre>
          </div>
          <p>So, if we make <code>say</code> an abstract method, it’d look like this:</p>
          <div class="sourceCode" id="cb12">
            <pre
              class="sourceCode java"
            ><code class="sourceCode java"><span id="cb12-1"><a href="#cb12-1" aria-hidden="true" tabindex="-1"></a><span class="dt">void</span> <span class="fu">say</span><span class="op">(</span><span class="bu">String</span> message<span class="op">);</span>  <span class="co">/* &lt;-- This is the signature */</span></span></code></pre>
          </div>
          <details>
            <summary>A bit more info for the curious (and for the pedants &lt;3)</summary>
            Actual abstract methods in java use the <code>abstract</code> keyword. So it’d
            actually look like <code>abstract void say(String message);</code>, and it’d
            be part of an <code>abstract class</code> instead of just a
            <code>class</code>. I chose to skip that to avoid throwing out too many things
            once.
          </details>
          <p>
            So, it’d be just the method signature, right? And- hold on- that’s exactly
            what we put on the interface! That’s the reason why we can’t just create an
            object from an interface, the methods don’t have any implementation (code).
            Java would not know what to do at all if you called those methods.
          </p>
          <p>
            Here’s the important bit about interfaces, the methods are there so that
            classes can implement them- not the interface. A class that implements those
            methods (i.e. has methods with the same signatures as the interface) can tell
            java that it, in fact, implements the interface. So, if a class implements
            <code>Talk</code>, java will happily let you put objects of that class into a
            variable of type <code>Talk</code>.
          </p>
          <p>Worry not, for I have more examples!</p>
          <p>
            Here’s the interface again, I copied and pasted it so that you don’t have to
            scroll up.
          </p>
          <div class="sourceCode" id="cb13">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb13-1"><a href="#cb13-1" aria-hidden="true" tabindex="-1"></a><span class="kw">interface</span> Talk <span class="op">{</span></span>
<span id="cb13-2"><a href="#cb13-2" aria-hidden="true" tabindex="-1"></a>    <span class="dt">void</span> <span class="fu">speak</span><span class="op">(</span><span class="bu">String</span> message<span class="op">);</span></span>
<span id="cb13-3"><a href="#cb13-3" aria-hidden="true" tabindex="-1"></a>    <span class="dt">void</span> <span class="fu">yell</span><span class="op">();</span></span>
<span id="cb13-4"><a href="#cb13-4" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>
            So, we need to create a class that implements the interface. Let’s start by
            making a normal class first. I’ll make a cat because my cat really likes to
            talk. This Cat class will be very simple, it’ll just have a name, and it’ll
            sleep.
          </p>
          <div class="sourceCode" id="cb14">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb14-1"><a href="#cb14-1" aria-hidden="true" tabindex="-1"></a><span class="kw">class</span> Cat <span class="op">{</span></span>
<span id="cb14-2"><a href="#cb14-2" aria-hidden="true" tabindex="-1"></a>    <span class="kw">private</span> <span class="bu">String</span> name<span class="op">;</span></span>
<span id="cb14-3"><a href="#cb14-3" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb14-4"><a href="#cb14-4" aria-hidden="true" tabindex="-1"></a>    <span class="fu">Cat</span><span class="op">(</span><span class="bu">String</span> name<span class="op">)</span> <span class="op">{</span></span>
<span id="cb14-5"><a href="#cb14-5" aria-hidden="true" tabindex="-1"></a>        <span class="kw">this</span><span class="op">.</span><span class="fu">name</span> <span class="op">=</span> name<span class="op">;</span></span>
<span id="cb14-6"><a href="#cb14-6" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb14-7"><a href="#cb14-7" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb14-8"><a href="#cb14-8" aria-hidden="true" tabindex="-1"></a>    <span class="dt">void</span> <span class="fu">sleep</span><span class="op">(</span><span class="dt">int</span> hours<span class="op">)</span> <span class="op">{</span></span>
<span id="cb14-9"><a href="#cb14-9" aria-hidden="true" tabindex="-1"></a>        <span class="cf">for</span> <span class="op">(</span><span class="dt">int</span> i <span class="op">=</span> <span class="dv">0</span><span class="op">;</span> i <span class="op">&lt;</span> hours<span class="op">;</span> i<span class="op">++)</span> <span class="op">{</span></span>
<span id="cb14-10"><a href="#cb14-10" aria-hidden="true" tabindex="-1"></a>            UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;zzzzzzzzzzzzzz&quot;</span><span class="op">);</span></span>
<span id="cb14-11"><a href="#cb14-11" aria-hidden="true" tabindex="-1"></a>        <span class="op">}</span></span>
<span id="cb14-12"><a href="#cb14-12" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb14-13"><a href="#cb14-13" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>Okay! We have a cat now! Let’s make it talk! I’ll go step by step.</p>
          <p>
            The first thing you’ll want to do is to modify the class signature. (It just
            means changing <code>class Cat</code> to something else). We have to tell java
            that we’ll be implementing the methods of the <code>Talk</code> interface. If
            we don’t, it won’t know what we’re trying to do. The change is quite
            straightforward.
          </p>
          <div class="sourceCode" id="cb15">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb15-1"><a href="#cb15-1" aria-hidden="true" tabindex="-1"></a><span class="kw">class</span> Cat <span class="kw">implements</span> Talk <span class="op">{</span></span>
<span id="cb15-2"><a href="#cb15-2" aria-hidden="true" tabindex="-1"></a>    <span class="kw">private</span> <span class="bu">String</span> name<span class="op">;</span></span>
<span id="cb15-3"><a href="#cb15-3" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb15-4"><a href="#cb15-4" aria-hidden="true" tabindex="-1"></a>    <span class="fu">Cat</span><span class="op">(</span><span class="bu">String</span> name<span class="op">)</span> <span class="op">{</span></span>
<span id="cb15-5"><a href="#cb15-5" aria-hidden="true" tabindex="-1"></a>        <span class="kw">this</span><span class="op">.</span><span class="fu">name</span> <span class="op">=</span> name<span class="op">;</span></span>
<span id="cb15-6"><a href="#cb15-6" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb15-7"><a href="#cb15-7" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb15-8"><a href="#cb15-8" aria-hidden="true" tabindex="-1"></a>    <span class="dt">void</span> <span class="fu">sleep</span><span class="op">(</span><span class="dt">int</span> hours<span class="op">)</span> <span class="op">{</span></span>
<span id="cb15-9"><a href="#cb15-9" aria-hidden="true" tabindex="-1"></a>        <span class="cf">for</span> <span class="op">(</span><span class="dt">int</span> i <span class="op">=</span> <span class="dv">0</span><span class="op">;</span> i <span class="op">&lt;</span> hours<span class="op">;</span> i<span class="op">++)</span> <span class="op">{</span></span>
<span id="cb15-10"><a href="#cb15-10" aria-hidden="true" tabindex="-1"></a>            UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;zzzzzzzzzzzzzz&quot;</span><span class="op">);</span></span>
<span id="cb15-11"><a href="#cb15-11" aria-hidden="true" tabindex="-1"></a>        <span class="op">}</span></span>
<span id="cb15-12"><a href="#cb15-12" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb15-13"><a href="#cb15-13" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>
            Very nice! Something of note is that if we try to compile this as it is now,
            java will refuse. Take a look:
          </p>
          <pre class="plaintext"><code>Cat.java:1: error: Cat is not abstract and does not override abstract method yell() in Talk
class Cat implements Talk {
^
1 error</code></pre>
        <details>
          <summary>Further explanation of the error message</summary>
          We can see that it calls <code>yell</code> an abstract method. As we saw
          before, methods in interfaces are abstract by default. It also says that Cat
          is not an abstract class (yeah, those are a thing). Therefore, it expects us
          to actually implement those methods.
        </details>
        <p>
          This is because we haven’t implemented any of the methods listed on the
            interface. Java isn’t happy that we lied to it about implementing
            <code>Talk</code> :(
          </p>
          <p>
            Let’s create those methods! We’ll leave them empty at first just to try it
            out. Something of note is that those interface methods
            <strong>have</strong> to be public. It makes sense when you think about it,
            why tell me you have some methods if I can’t use them?
          </p>
          <div class="sourceCode" id="cb17">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb17-1"><a href="#cb17-1" aria-hidden="true" tabindex="-1"></a><span class="kw">class</span> Cat <span class="kw">implements</span> Talk <span class="op">{</span></span>
<span id="cb17-2"><a href="#cb17-2" aria-hidden="true" tabindex="-1"></a>    <span class="kw">private</span> <span class="bu">String</span> name<span class="op">;</span></span>
<span id="cb17-3"><a href="#cb17-3" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb17-4"><a href="#cb17-4" aria-hidden="true" tabindex="-1"></a>    <span class="fu">Cat</span><span class="op">(</span><span class="bu">String</span> name<span class="op">)</span> <span class="op">{</span></span>
<span id="cb17-5"><a href="#cb17-5" aria-hidden="true" tabindex="-1"></a>        <span class="kw">this</span><span class="op">.</span><span class="fu">name</span> <span class="op">=</span> name<span class="op">;</span></span>
<span id="cb17-6"><a href="#cb17-6" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb17-7"><a href="#cb17-7" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb17-8"><a href="#cb17-8" aria-hidden="true" tabindex="-1"></a>    <span class="dt">void</span> <span class="fu">sleep</span><span class="op">(</span><span class="dt">int</span> hours<span class="op">)</span> <span class="op">{</span></span>
<span id="cb17-9"><a href="#cb17-9" aria-hidden="true" tabindex="-1"></a>        <span class="cf">for</span> <span class="op">(</span><span class="dt">int</span> i <span class="op">=</span> <span class="dv">0</span><span class="op">;</span> i <span class="op">&lt;</span> hours<span class="op">;</span> i<span class="op">++)</span> <span class="op">{</span></span>
<span id="cb17-10"><a href="#cb17-10" aria-hidden="true" tabindex="-1"></a>            UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;zzzzzzzzzzzzzz&quot;</span><span class="op">);</span></span>
<span id="cb17-11"><a href="#cb17-11" aria-hidden="true" tabindex="-1"></a>        <span class="op">}</span></span>
<span id="cb17-12"><a href="#cb17-12" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb17-13"><a href="#cb17-13" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb17-14"><a href="#cb17-14" aria-hidden="true" tabindex="-1"></a>    <span class="kw">public</span> <span class="dt">void</span> <span class="fu">speak</span><span class="op">(</span><span class="bu">String</span> message<span class="op">)</span> <span class="op">{</span></span>
<span id="cb17-15"><a href="#cb17-15" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb17-16"><a href="#cb17-16" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb17-17"><a href="#cb17-17" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb17-18"><a href="#cb17-18" aria-hidden="true" tabindex="-1"></a>    <span class="kw">public</span> <span class="dt">void</span> <span class="fu">yell</span><span class="op">()</span> <span class="op">{</span></span>
<span id="cb17-19"><a href="#cb17-19" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb17-20"><a href="#cb17-20" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb17-21"><a href="#cb17-21" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>
            If we try to create a new <code>Cat</code> now and put it into a variable of
            type <code>Talk</code>, you’ll find that java is okay with it!
          </p>
          <div class="sourceCode" id="cb18">
            <pre
              class="sourceCode java"
            ><code class="sourceCode java"><span id="cb18-1"><a href="#cb18-1" aria-hidden="true" tabindex="-1"></a>Talk speaker <span class="op">=</span> <span class="kw">new</span> <span class="fu">Cat</span><span class="op">(</span><span class="st">&quot;Sparrow Spanner&quot;</span><span class="op">);</span></span></code></pre>
          </div>
          <p>
            We implemented the methods that we promised java we would have, so it’s happy
            to let us do our own thing. Before moving on, let’s write some code so that
            those methods actually do something.
          </p>
          <div class="sourceCode" id="cb19">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb19-1"><a href="#cb19-1" aria-hidden="true" tabindex="-1"></a><span class="kw">class</span> Cat <span class="kw">implements</span> Talk <span class="op">{</span></span>
<span id="cb19-2"><a href="#cb19-2" aria-hidden="true" tabindex="-1"></a>    <span class="kw">private</span> <span class="bu">String</span> name<span class="op">;</span></span>
<span id="cb19-3"><a href="#cb19-3" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb19-4"><a href="#cb19-4" aria-hidden="true" tabindex="-1"></a>    <span class="fu">Cat</span><span class="op">(</span><span class="bu">String</span> name<span class="op">)</span> <span class="op">{</span></span>
<span id="cb19-5"><a href="#cb19-5" aria-hidden="true" tabindex="-1"></a>        <span class="kw">this</span><span class="op">.</span><span class="fu">name</span> <span class="op">=</span> name<span class="op">;</span></span>
<span id="cb19-6"><a href="#cb19-6" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb19-7"><a href="#cb19-7" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb19-8"><a href="#cb19-8" aria-hidden="true" tabindex="-1"></a>    <span class="dt">void</span> <span class="fu">sleep</span><span class="op">(</span><span class="dt">int</span> hours<span class="op">)</span> <span class="op">{</span></span>
<span id="cb19-9"><a href="#cb19-9" aria-hidden="true" tabindex="-1"></a>        <span class="cf">for</span> <span class="op">(</span><span class="dt">int</span> i <span class="op">=</span> <span class="dv">0</span><span class="op">;</span> i <span class="op">&lt;</span> hours<span class="op">;</span> i<span class="op">++)</span> <span class="op">{</span></span>
<span id="cb19-10"><a href="#cb19-10" aria-hidden="true" tabindex="-1"></a>            UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;zzzzzzzzzzzzzz&quot;</span><span class="op">);</span></span>
<span id="cb19-11"><a href="#cb19-11" aria-hidden="true" tabindex="-1"></a>        <span class="op">}</span></span>
<span id="cb19-12"><a href="#cb19-12" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb19-13"><a href="#cb19-13" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb19-14"><a href="#cb19-14" aria-hidden="true" tabindex="-1"></a>    <span class="kw">public</span> <span class="dt">void</span> <span class="fu">speak</span><span class="op">(</span><span class="bu">String</span> message<span class="op">)</span> <span class="op">{</span></span>
<span id="cb19-15"><a href="#cb19-15" aria-hidden="true" tabindex="-1"></a>        UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;I am &quot;</span> <span class="op">+</span> name <span class="op">+</span><span class="st">&quot;, I guess. I say: &quot;</span> <span class="op">+</span> message<span class="op">);</span></span>
<span id="cb19-16"><a href="#cb19-16" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb19-17"><a href="#cb19-17" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb19-18"><a href="#cb19-18" aria-hidden="true" tabindex="-1"></a>    <span class="kw">public</span> <span class="dt">void</span> <span class="fu">yell</span><span class="op">()</span> <span class="op">{</span></span>
<span id="cb19-19"><a href="#cb19-19" aria-hidden="true" tabindex="-1"></a>        UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;MRRRAAAAAAAWWW&quot;</span><span class="op">);</span></span>
<span id="cb19-20"><a href="#cb19-20" aria-hidden="true" tabindex="-1"></a>    <span class="op">}</span></span>
<span id="cb19-21"><a href="#cb19-21" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>
            So what can we actually do with this <code>speaker</code> variable? Let’s try
            calling some methods! We’ll start by the methods from the interface (<code
              >speak</code
            >
            and <code>yell</code>).
          </p>
          <div class="sourceCode" id="cb20">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb20-1"><a href="#cb20-1" aria-hidden="true" tabindex="-1"></a><span class="co">// Prints: I am Sparrow Spanner, I guess. I say: hi!</span></span>
<span id="cb20-2"><a href="#cb20-2" aria-hidden="true" tabindex="-1"></a>speaker<span class="op">.</span><span class="fu">speak</span><span class="op">(</span><span class="st">&quot;hi!&quot;</span><span class="op">);</span></span>
<span id="cb20-3"><a href="#cb20-3" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb20-4"><a href="#cb20-4" aria-hidden="true" tabindex="-1"></a><span class="co">// Prints: MRRRAAAAAAAWWW</span></span>
<span id="cb20-5"><a href="#cb20-5" aria-hidden="true" tabindex="-1"></a>speaker<span class="op">.</span><span class="fu">yell</span><span class="op">();</span></span></code></pre>
          </div>
          <p>
            Nice! That’s what we expected. What if I we try to be sneaky and call a method
            that is specific to <code>Cat</code>? Let’s try and make our cat
            <code>sleep</code> for a couple hours.
          </p>
          <div class="sourceCode" id="cb21">
            <pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb21-1"><a href="#cb21-1" aria-hidden="true" tabindex="-1"></a><span class="co">// Sneaky time</span></span>
<span id="cb21-2"><a href="#cb21-2" aria-hidden="true" tabindex="-1"></a>speaker<span class="op">.</span><span class="fu">sleep</span><span class="op">(</span><span class="dv">20</span><span class="op">);</span></span></code></pre>
          </div>
          <p>Java is not very happy about our trickery:</p>
          <pre class="plaintext"><code>Cat.java:24: error: cannot find symbol
    speaker.sleep(20);
           ^
  symbol:   method sleep(int)
  location: variable speaker of type Talk
1 error</code></pre>
          <p>
            If we break down the error, java is saying that this variable of
            <em>type Talk</em> doesn’t have a method called sleep. And well… this is true.
            The interface <code>Talk</code> doesn’t specify a method called
            <code>sleep</code>. So if a variable is type <code>Talk</code>, then you can
            only call the methods specified in the interface <code>Talk</code>. It doesn’t
            matter that we put a <code>Cat</code> into it, we told java it was a
            <code>Talk</code>, so we can only use <code>Talk</code> things.
          </p>
          <p>
            If we have just one class in a program, the interface doesn’t seem that
            useful. However they come in handy once you have multiple classes in your
            project.
          </p>
          <h2 id="many-objects">Many objects !!</h2>
          <p>
            Let’s make a bunch of classes that implement interface in addition to our
            <code>Cat</code>. I’ll make a <code>Person</code> and a
            <code>Loudspeaker</code>. If it helps you to have a context, imagine we have a
            file with some info, and we create one of these object depending on what the
            file says.
          </p>
          <p>I’ll copy and paste the interface code again for reference.</p>
          <div class="sourceCode" id="cb23">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb23-1"><a href="#cb23-1" aria-hidden="true" tabindex="-1"></a><span class="kw">interface</span> Talk <span class="op">{</span></span>
<span id="cb23-2"><a href="#cb23-2" aria-hidden="true" tabindex="-1"></a>    <span class="dt">void</span> <span class="fu">speak</span><span class="op">(</span><span class="bu">String</span> message<span class="op">);</span></span>
<span id="cb23-3"><a href="#cb23-3" aria-hidden="true" tabindex="-1"></a>    <span class="dt">void</span> <span class="fu">yell</span><span class="op">();</span></span>
<span id="cb23-4"><a href="#cb23-4" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>
            This example does mean that I have to make more classes, the code blocks might
            seem big but that’s just because java is pretty verbose. I won’t really
            explain the classes, they’re pretty simple. However- if you want me to, just
            send me a message and I’ll add more stuff.
          </p>
          <p>Here’s our Person:</p>
          <div class="sourceCode" id="cb24">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb24-1"><a href="#cb24-1" aria-hidden="true" tabindex="-1"></a><span class="kw">class</span> Person <span class="kw">implements</span> Talk <span class="op">{</span></span>
<span id="cb24-2"><a href="#cb24-2" aria-hidden="true" tabindex="-1"></a>  <span class="bu">String</span> firstName<span class="op">;</span></span>
<span id="cb24-3"><a href="#cb24-3" aria-hidden="true" tabindex="-1"></a>  <span class="bu">String</span> lastName<span class="op">;</span></span>
<span id="cb24-4"><a href="#cb24-4" aria-hidden="true" tabindex="-1"></a>  <span class="bu">String</span> job<span class="op">;</span></span>
<span id="cb24-5"><a href="#cb24-5" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb24-6"><a href="#cb24-6" aria-hidden="true" tabindex="-1"></a>  <span class="fu">Person</span><span class="op">(</span><span class="bu">String</span> firstName<span class="op">,</span> <span class="bu">String</span> lastName<span class="op">,</span> <span class="bu">String</span> job<span class="op">)</span> <span class="op">{</span></span>
<span id="cb24-7"><a href="#cb24-7" aria-hidden="true" tabindex="-1"></a>    <span class="kw">this</span><span class="op">.</span><span class="fu">firstName</span> <span class="op">=</span> firstName<span class="op">;</span></span>
<span id="cb24-8"><a href="#cb24-8" aria-hidden="true" tabindex="-1"></a>    <span class="kw">this</span><span class="op">.</span><span class="fu">lastName</span> <span class="op">=</span> lastName<span class="op">;</span></span>
<span id="cb24-9"><a href="#cb24-9" aria-hidden="true" tabindex="-1"></a>    <span class="kw">this</span><span class="op">.</span><span class="fu">job</span> <span class="op">=</span> job<span class="op">;</span></span>
<span id="cb24-10"><a href="#cb24-10" aria-hidden="true" tabindex="-1"></a>  <span class="op">}</span></span>
<span id="cb24-11"><a href="#cb24-11" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb24-12"><a href="#cb24-12" aria-hidden="true" tabindex="-1"></a>  <span class="co">// Interface methods</span></span>
<span id="cb24-13"><a href="#cb24-13" aria-hidden="true" tabindex="-1"></a>  <span class="kw">public</span> <span class="dt">void</span> <span class="fu">speak</span><span class="op">(</span><span class="bu">String</span> message<span class="op">)</span> <span class="op">{</span></span>
<span id="cb24-14"><a href="#cb24-14" aria-hidden="true" tabindex="-1"></a>    UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;Hello I&#39;m &quot;</span> <span class="op">+</span> firstName <span class="op">+</span> <span class="st">&quot; &quot;</span> <span class="op">+</span> lastName <span class="op">+</span> <span class="st">&quot; and I&#39;m the CEO of &quot;</span> <span class="op">+</span> job <span class="op">+</span> <span class="st">&quot;. I say that: &quot;</span> <span class="op">+</span> message<span class="op">);</span></span>
<span id="cb24-15"><a href="#cb24-15" aria-hidden="true" tabindex="-1"></a>  <span class="op">}</span></span>
<span id="cb24-16"><a href="#cb24-16" aria-hidden="true" tabindex="-1"></a>  <span class="kw">public</span> <span class="dt">void</span> <span class="fu">yell</span><span class="op">()</span> <span class="op">{</span></span>
<span id="cb24-17"><a href="#cb24-17" aria-hidden="true" tabindex="-1"></a>    <span class="co">// We can use our own variables when implementing the method, that&#39;s okay!</span></span>
<span id="cb24-18"><a href="#cb24-18" aria-hidden="true" tabindex="-1"></a>    UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;RAAAAAAAAAAAGGGGGHHHHH, I HATE &quot;</span> <span class="op">+</span> job<span class="op">.</span><span class="fu">toUpperCase</span><span class="op">());</span></span>
<span id="cb24-19"><a href="#cb24-19" aria-hidden="true" tabindex="-1"></a>  <span class="op">}</span></span>
<span id="cb24-20"><a href="#cb24-20" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>
            Now for the loudspeaker. (It might seem a bit odd to have a
            <code>Talk</code>ing loudspeaker, but that’s just a naming thing. Our
            interface could instead be named <code>MakesNoise</code> and our methods be
            called <code>quiet</code> and <code>loud</code>. It would function the same
            way. I just chose <code>Talk</code> because easier to read than
            <code>MakeNoise</code>). Here it is:
          </p>
          <div class="sourceCode" id="cb25">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb25-1"><a href="#cb25-1" aria-hidden="true" tabindex="-1"></a><span class="kw">class</span> Loudspeaker <span class="kw">implements</span> Talk <span class="op">{</span></span>
<span id="cb25-2"><a href="#cb25-2" aria-hidden="true" tabindex="-1"></a>  <span class="fu">Loudspeaker</span><span class="op">()</span> <span class="op">{</span></span>
<span id="cb25-3"><a href="#cb25-3" aria-hidden="true" tabindex="-1"></a>    <span class="co">// We don&#39;t have anything to set up here.</span></span>
<span id="cb25-4"><a href="#cb25-4" aria-hidden="true" tabindex="-1"></a>  <span class="op">}</span></span>
<span id="cb25-5"><a href="#cb25-5" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb25-6"><a href="#cb25-6" aria-hidden="true" tabindex="-1"></a>  <span class="co">// Interface methods</span></span>
<span id="cb25-7"><a href="#cb25-7" aria-hidden="true" tabindex="-1"></a>  <span class="kw">public</span> <span class="dt">void</span> <span class="fu">speak</span><span class="op">(</span><span class="bu">String</span> message<span class="op">)</span> <span class="op">{</span></span>
<span id="cb25-8"><a href="#cb25-8" aria-hidden="true" tabindex="-1"></a>    UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;🎶🎵 &quot;</span> <span class="op">+</span> message <span class="op">+</span> <span class="st">&quot; 🎶🎷&quot;</span><span class="op">);</span></span>
<span id="cb25-9"><a href="#cb25-9" aria-hidden="true" tabindex="-1"></a>  <span class="op">}</span></span>
<span id="cb25-10"><a href="#cb25-10" aria-hidden="true" tabindex="-1"></a></span>
<span id="cb25-11"><a href="#cb25-11" aria-hidden="true" tabindex="-1"></a>  <span class="kw">public</span> <span class="dt">void</span> <span class="fu">yell</span><span class="op">()</span> <span class="op">{</span></span>
<span id="cb25-12"><a href="#cb25-12" aria-hidden="true" tabindex="-1"></a>    UI<span class="op">.</span><span class="fu">println</span><span class="op">(</span><span class="st">&quot;BBBBBBBBBBBBBBBBBBBBBZZZZZZZ&quot;</span><span class="op">);</span></span>
<span id="cb25-13"><a href="#cb25-13" aria-hidden="true" tabindex="-1"></a>  <span class="op">}</span></span>
<span id="cb25-14"><a href="#cb25-14" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>
            You can imagine these classes having other non-interface methods, for example
            <code>Person</code> could have a method called <code>writeJava</code>. I chose
            not to write them in to keep it simple, but in your actual code they most
            likely have a bunch of non-interface methods… which is okay!
          </p>
          <p>
            I won’t- like- code a loop that reads from a file and creates objects based on
            that. That is left as an exercise to the reader ;). I’ll just create the
            objects manually.
          </p>
          <p>
            Let’s make some of these objects! We’ll just have an
            <code>ArrayList</code> with the type <code>Talk</code> to keep track of all of
            them.
          </p>
          <div class="sourceCode" id="cb26">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb26-1"><a href="#cb26-1" aria-hidden="true" tabindex="-1"></a><span class="bu">ArrayList</span><span class="op">&lt;</span>Talk<span class="op">&gt;</span> talkObjects <span class="op">=</span> <span class="kw">new</span> <span class="bu">ArrayList</span><span class="op">&lt;&gt;();</span></span>
<span id="cb26-2"><a href="#cb26-2" aria-hidden="true" tabindex="-1"></a><span class="co">// Because all these objects implement Talk, we can put them in the ArrayList</span></span>
<span id="cb26-3"><a href="#cb26-3" aria-hidden="true" tabindex="-1"></a><span class="co">// the same way that we put a Cat into a variable of type Talk earlier</span></span>
<span id="cb26-4"><a href="#cb26-4" aria-hidden="true" tabindex="-1"></a>talkObjects<span class="op">.</span><span class="fu">add</span><span class="op">(</span><span class="kw">new</span> <span class="fu">Cat</span><span class="op">(</span><span class="st">&quot;Missile Launcher&quot;</span><span class="op">));</span></span>
<span id="cb26-5"><a href="#cb26-5" aria-hidden="true" tabindex="-1"></a>talkObjects<span class="op">.</span><span class="fu">add</span><span class="op">(</span><span class="kw">new</span> <span class="fu">Person</span><span class="op">(</span><span class="st">&quot;John&quot;</span><span class="op">,</span> <span class="st">&quot;Java&quot;</span><span class="op">,</span> <span class="st">&quot;programming&quot;</span><span class="op">));</span></span>
<span id="cb26-6"><a href="#cb26-6" aria-hidden="true" tabindex="-1"></a>talkObjects<span class="op">.</span><span class="fu">add</span><span class="op">(</span><span class="kw">new</span> <span class="fu">Cat</span><span class="op">(</span><span class="st">&quot;Mabel&quot;</span><span class="op">));</span></span>
<span id="cb26-7"><a href="#cb26-7" aria-hidden="true" tabindex="-1"></a>talkObjects<span class="op">.</span><span class="fu">add</span><span class="op">(</span><span class="kw">new</span> <span class="fu">Loudspeaker</span><span class="op">());</span></span>
<span id="cb26-8"><a href="#cb26-8" aria-hidden="true" tabindex="-1"></a>talkObjects<span class="op">.</span><span class="fu">add</span><span class="op">(</span><span class="kw">new</span> <span class="fu">Person</span><span class="op">(</span><span class="st">&quot;Ben&quot;</span><span class="op">,</span> <span class="st">&quot;Bacon&quot;</span><span class="op">,</span> <span class="st">&quot;accounting&quot;</span><span class="op">));</span></span></code></pre>
          </div>
          <p>
            This compiles fine! Let’s actually use the interface methods. First we’ll make
            them all speak.
          </p>
          <div class="sourceCode" id="cb27">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb27-1"><a href="#cb27-1" aria-hidden="true" tabindex="-1"></a><span class="cf">for</span> <span class="op">(</span>Talk speaker<span class="op">:</span> talkObjects<span class="op">)</span> <span class="op">{</span></span>
<span id="cb27-2"><a href="#cb27-2" aria-hidden="true" tabindex="-1"></a>    speaker<span class="op">.</span><span class="fu">speak</span><span class="op">(</span><span class="st">&quot;I love bread&quot;</span><span class="op">);</span>  <span class="co">// I really do</span></span>
<span id="cb27-3"><a href="#cb27-3" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>This will print out the following:</p>
<pre class="plaintext"><code>I am Missile Launcher, I guess. I say: I love bread
Hello I&#39;m John Java and I&#39;m the CEO of programming. I say that: I love bread
I am Mabel, I guess. I say: I love bread
🎶🎵 I love bread 🎶🎷
Hello I&#39;m Ben Bacon and I&#39;m the CEO of accounting. I say that: I love bread</code></pre>
          <p>
            Isn’t that cool!! We stored a bunch of different objects on the same
            ArrayList, and we called a method on all of them! I hope you can see how this
            can be useful on larger programs. Maybe you’re making a game with a lot of
            different objects and your method for saving the game calls
            <code>.save()</code> on a ton of them. The possibilities are endless!
          </p>
          <p>Let’s try our <code>yell</code> method!</p>
          <div class="sourceCode" id="cb29">
<pre
class="sourceCode java"
><code class="sourceCode java"><span id="cb29-1"><a href="#cb29-1" aria-hidden="true" tabindex="-1"></a><span class="cf">for</span> <span class="op">(</span>Talk speaker<span class="op">:</span> talkObjects<span class="op">)</span> <span class="op">{</span></span>
<span id="cb29-2"><a href="#cb29-2" aria-hidden="true" tabindex="-1"></a>    speaker<span class="op">.</span><span class="fu">yell</span><span class="op">();</span>  <span class="co">// Let&#39;s be loud!!</span></span>
<span id="cb29-3"><a href="#cb29-3" aria-hidden="true" tabindex="-1"></a><span class="op">}</span></span></code></pre>
          </div>
          <p>This will print out the following:</p>
<pre class="plaintext"><code>MRRRAAAAAAAWWW
RAAAAAAAAAAAGGGGGHHHHH, I HATE PROGRAMMING
MRRRAAAAAAAWWW
BBBBBBBBBBBBBBBBBBBBBZZZZZZZ
RAAAAAAAAAAAGGGGGHHHHH, I HATE ACCOUNTING</code></pre>
          <h2 id="final-thoughts">Final thoughts</h2>
          <p>
            Isn’t that great. Hopefully by now your brain has expanded to the size of a
            bowling ball perhaps a watermelon. If it’s not clear I recommend giving it
            some time to sink in and then re-reading it a day or so later. If that doesn’t
            help then feel free to ask on the COMP server and ping me or Ryan (he
            volunteered I swear).
          </p>
          <p>
            Once again, if you want to see it in action or mess with the source code (I
            recommend doing this, you really learn a lot by modifying things and seeing
            what breaks) you can find it
            <a href="/guides/samples/Interfaces.java">on this link here.</a>
          </p>
          <p>
            If there’s anything that you think needs editing or clarification, send me a
            DM and I’ll update this guide. If you found it helpful I’d really appreciate a
            message about it :), I might write more in the future.
          </p>
          <p>This guide’s version is <code>v1.1</code>.</p>
          <!--
          # backburner

          When you declare a variable, you're telling java: I want the value of `name` to
          have the features of `Class`.

          Say like, *why* implement the interface. You could just create the methods,
          right? Wronk! You need to tell java explicitly that those methods are part of
          the interface. It won't try and guess.

          Examples of shapes that can be drawn. Interface Drawable with Draw. Shape
          objects like circle, square, triangle.

          Why declare something as interface instead of just the object? It's good to declare things with the type that has *just* what you need.

          Interfaces can define variables (members) as well, but that's something we'll touch on lecture i think.
          -->
        </main>
        <?php require $_SERVER["DOCUMENT_ROOT"] . "footer.html"; ?>
    </body>
</html>

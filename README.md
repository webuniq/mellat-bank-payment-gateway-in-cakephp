mellat bank payment gateway in cakephp
======================================
<h2>
<a href="#installation" class="anchor" name="installation"><span class="octicon octicon-link"></span></a>Installation</h2>
<ul>
<li>Copy the file <code>Controller/Component/MellatPaymentComponent.php</code> to the <code>Controller/Component</code> folder of your application</li>

<li>Add the following code to <code>Config/core.php</code>:
<pre>
<span>// - - - - - - - - Mellat Payment - - - - - - - - - -</span>
<span>Configure::write('Settings.pay.terminalId', '00000');</span>
<span>Configure::write('Settings.pay.userName', '--user--');</span>
<span>Configure::write('Settings.pay.password', '--pass--');</span>
<span>// - - - - - - - - Mellat Payment - - - - - - - - - -</span>
</pre>
</ul>
</li>
<h2>
<a href="#contact" class="anchor" name="contact"><span class="octicon octicon-link"></span></a>Contact</h2>
<p>Feel free to contact me via Twitter (<a href="https://twitter.com/webuniq">@webuniq</a>) or visit our site (<a href="http://www.webuniq.com/">webuniq.com</a>).</p>
<h2>
<a href="#license" class="anchor" name="license"><span class="octicon octicon-link"></span></a>License</h2>
<p>The MellatPayment component is licensed under the GPL v2 license.</p>


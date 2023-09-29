<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()>
Partial Class login
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()>
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()>
    Private Sub InitializeComponent()
        Me.components = New System.ComponentModel.Container()
        Me.Timer1 = New System.Windows.Forms.Timer(Me.components)
        Me.Timer2 = New System.Windows.Forms.Timer(Me.components)
        Me.Panel1 = New System.Windows.Forms.Panel()
        Me.Panel2 = New System.Windows.Forms.Panel()
        Me.Panel3 = New System.Windows.Forms.Panel()
        Me.txtToday = New System.Windows.Forms.Label()
        Me.Panel4 = New System.Windows.Forms.Panel()
        Me.imgFinger = New System.Windows.Forms.PictureBox()
        Me.lblLoading = New System.Windows.Forms.Label()
        Me.lblDate = New System.Windows.Forms.Label()
        Me.ProgressBar1 = New System.Windows.Forms.ProgressBar()
        Me.lblTime = New System.Windows.Forms.Label()
        Me.Label4 = New System.Windows.Forms.Label()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.Label2 = New System.Windows.Forms.Label()
        Me.TextBox1 = New System.Windows.Forms.TextBox()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.Picture = New System.Windows.Forms.PictureBox()
        Me.Button1 = New System.Windows.Forms.Button()
        Me.lblToday = New System.Windows.Forms.Label()
        Me.Panel1.SuspendLayout()
        Me.Panel2.SuspendLayout()
        Me.Panel3.SuspendLayout()
        CType(Me.imgFinger, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.Picture, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'Timer1
        '
        Me.Timer1.Interval = 1000
        '
        'Timer2
        '
        '
        'Panel1
        '
        Me.Panel1.BackgroundImage = Global.blmc_payroll.My.Resources.Resources.ey_finger_print_scanner_v1
        Me.Panel1.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Center
        Me.Panel1.Controls.Add(Me.Panel2)
        Me.Panel1.Controls.Add(Me.Button1)
        Me.Panel1.Dock = System.Windows.Forms.DockStyle.Fill
        Me.Panel1.Location = New System.Drawing.Point(0, 0)
        Me.Panel1.Name = "Panel1"
        Me.Panel1.Size = New System.Drawing.Size(1748, 1325)
        Me.Panel1.TabIndex = 45
        '
        'Panel2
        '
        Me.Panel2.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle
        Me.Panel2.Controls.Add(Me.Panel3)
        Me.Panel2.Controls.Add(Me.lblToday)
        Me.Panel2.Controls.Add(Me.Panel4)
        Me.Panel2.Controls.Add(Me.imgFinger)
        Me.Panel2.Controls.Add(Me.lblLoading)
        Me.Panel2.Controls.Add(Me.lblDate)
        Me.Panel2.Controls.Add(Me.ProgressBar1)
        Me.Panel2.Controls.Add(Me.lblTime)
        Me.Panel2.Controls.Add(Me.Label4)
        Me.Panel2.Controls.Add(Me.Label3)
        Me.Panel2.Controls.Add(Me.Label2)
        Me.Panel2.Controls.Add(Me.TextBox1)
        Me.Panel2.Controls.Add(Me.Label1)
        Me.Panel2.Controls.Add(Me.Picture)
        Me.Panel2.Location = New System.Drawing.Point(155, 135)
        Me.Panel2.Name = "Panel2"
        Me.Panel2.Size = New System.Drawing.Size(779, 445)
        Me.Panel2.TabIndex = 46
        '
        'Panel3
        '
        Me.Panel3.BackColor = System.Drawing.Color.Brown
        Me.Panel3.Controls.Add(Me.txtToday)
        Me.Panel3.Location = New System.Drawing.Point(298, 18)
        Me.Panel3.Name = "Panel3"
        Me.Panel3.Size = New System.Drawing.Size(185, 55)
        Me.Panel3.TabIndex = 47
        '
        'txtToday
        '
        Me.txtToday.Font = New System.Drawing.Font("Segoe UI", 9.75!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.txtToday.ForeColor = System.Drawing.Color.White
        Me.txtToday.Location = New System.Drawing.Point(13, 16)
        Me.txtToday.Margin = New System.Windows.Forms.Padding(4, 0, 4, 0)
        Me.txtToday.Name = "txtToday"
        Me.txtToday.Size = New System.Drawing.Size(172, 29)
        Me.txtToday.TabIndex = 26
        Me.txtToday.Text = "Today"
        Me.txtToday.TextAlign = System.Drawing.ContentAlignment.TopCenter
        '
        'Panel4
        '
        Me.Panel4.BackColor = System.Drawing.Color.Brown
        Me.Panel4.Location = New System.Drawing.Point(0, 43)
        Me.Panel4.Name = "Panel4"
        Me.Panel4.Size = New System.Drawing.Size(788, 8)
        Me.Panel4.TabIndex = 48
        '
        'imgFinger
        '
        Me.imgFinger.Image = Global.blmc_payroll.My.Resources.Resources.fingerprint
        Me.imgFinger.Location = New System.Drawing.Point(46, 97)
        Me.imgFinger.Name = "imgFinger"
        Me.imgFinger.Size = New System.Drawing.Size(256, 287)
        Me.imgFinger.SizeMode = System.Windows.Forms.PictureBoxSizeMode.CenterImage
        Me.imgFinger.TabIndex = 44
        Me.imgFinger.TabStop = False
        '
        'lblLoading
        '
        Me.lblLoading.AutoSize = True
        Me.lblLoading.Font = New System.Drawing.Font("Segoe UI", 9.75!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.lblLoading.Location = New System.Drawing.Point(42, 405)
        Me.lblLoading.Margin = New System.Windows.Forms.Padding(4, 0, 4, 0)
        Me.lblLoading.Name = "lblLoading"
        Me.lblLoading.Size = New System.Drawing.Size(24, 23)
        Me.lblLoading.TabIndex = 45
        Me.lblLoading.Text = "--"
        '
        'lblDate
        '
        Me.lblDate.AutoSize = True
        Me.lblDate.Font = New System.Drawing.Font("Segoe UI Semibold", 16.2!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.lblDate.Location = New System.Drawing.Point(333, 313)
        Me.lblDate.Margin = New System.Windows.Forms.Padding(4, 0, 4, 0)
        Me.lblDate.Name = "lblDate"
        Me.lblDate.Size = New System.Drawing.Size(97, 38)
        Me.lblDate.TabIndex = 40
        Me.lblDate.Text = "m-d-Y"
        '
        'ProgressBar1
        '
        Me.ProgressBar1.Location = New System.Drawing.Point(-9, 437)
        Me.ProgressBar1.Margin = New System.Windows.Forms.Padding(4)
        Me.ProgressBar1.Name = "ProgressBar1"
        Me.ProgressBar1.Size = New System.Drawing.Size(788, 10)
        Me.ProgressBar1.TabIndex = 36
        Me.ProgressBar1.Visible = False
        '
        'lblTime
        '
        Me.lblTime.AutoSize = True
        Me.lblTime.Font = New System.Drawing.Font("Segoe UI Semibold", 16.2!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.lblTime.Location = New System.Drawing.Point(333, 231)
        Me.lblTime.Margin = New System.Windows.Forms.Padding(4, 0, 4, 0)
        Me.lblTime.Name = "lblTime"
        Me.lblTime.Size = New System.Drawing.Size(137, 38)
        Me.lblTime.TabIndex = 40
        Me.lblTime.Text = "hh:mm:ss"
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.Font = New System.Drawing.Font("Segoe UI", 9.75!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label4.Location = New System.Drawing.Point(336, 290)
        Me.Label4.Margin = New System.Windows.Forms.Padding(4, 0, 4, 0)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(50, 23)
        Me.Label4.TabIndex = 39
        Me.Label4.Text = "Date:"
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.Font = New System.Drawing.Font("Segoe UI", 9.75!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label3.Location = New System.Drawing.Point(333, 203)
        Me.Label3.Margin = New System.Windows.Forms.Padding(4, 0, 4, 0)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(51, 23)
        Me.Label3.TabIndex = 38
        Me.Label3.Text = "Time:"
        '
        'Label2
        '
        Me.Label2.Anchor = CType((((System.Windows.Forms.AnchorStyles.Top Or System.Windows.Forms.AnchorStyles.Bottom) _
            Or System.Windows.Forms.AnchorStyles.Left) _
            Or System.Windows.Forms.AnchorStyles.Right), System.Windows.Forms.AnchorStyles)
        Me.Label2.AutoSize = True
        Me.Label2.Location = New System.Drawing.Point(334, 128)
        Me.Label2.Margin = New System.Windows.Forms.Padding(4, 0, 4, 0)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(101, 16)
        Me.Label2.TabIndex = 35
        Me.Label2.Text = "Name Identified"
        '
        'TextBox1
        '
        Me.TextBox1.BackColor = System.Drawing.Color.White
        Me.TextBox1.BorderStyle = System.Windows.Forms.BorderStyle.None
        Me.TextBox1.Font = New System.Drawing.Font("Segoe UI", 18.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.TextBox1.Location = New System.Drawing.Point(337, 148)
        Me.TextBox1.Margin = New System.Windows.Forms.Padding(4)
        Me.TextBox1.Name = "TextBox1"
        Me.TextBox1.ReadOnly = True
        Me.TextBox1.Size = New System.Drawing.Size(354, 40)
        Me.TextBox1.TabIndex = 34
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Font = New System.Drawing.Font("Segoe UI", 9.75!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label1.Location = New System.Drawing.Point(333, 97)
        Me.Label1.Margin = New System.Windows.Forms.Padding(4, 0, 4, 0)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(166, 23)
        Me.Label1.TabIndex = 25
        Me.Label1.Text = "Scan Finger to Login"
        '
        'Picture
        '
        Me.Picture.BackColor = System.Drawing.Color.Transparent
        Me.Picture.Location = New System.Drawing.Point(46, 97)
        Me.Picture.Margin = New System.Windows.Forms.Padding(4)
        Me.Picture.Name = "Picture"
        Me.Picture.Size = New System.Drawing.Size(256, 287)
        Me.Picture.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom
        Me.Picture.TabIndex = 24
        Me.Picture.TabStop = False
        '
        'Button1
        '
        Me.Button1.Location = New System.Drawing.Point(13, 10)
        Me.Button1.Margin = New System.Windows.Forms.Padding(4)
        Me.Button1.Name = "Button1"
        Me.Button1.Size = New System.Drawing.Size(135, 47)
        Me.Button1.TabIndex = 37
        Me.Button1.Text = "New Enrollment"
        Me.Button1.UseVisualStyleBackColor = True
        '
        'lblToday
        '
        Me.lblToday.Anchor = CType((((System.Windows.Forms.AnchorStyles.Top Or System.Windows.Forms.AnchorStyles.Bottom) _
            Or System.Windows.Forms.AnchorStyles.Left) _
            Or System.Windows.Forms.AnchorStyles.Right), System.Windows.Forms.AnchorStyles)
        Me.lblToday.AutoSize = True
        Me.lblToday.Location = New System.Drawing.Point(394, 0)
        Me.lblToday.Margin = New System.Windows.Forms.Padding(4, 0, 4, 0)
        Me.lblToday.Name = "lblToday"
        Me.lblToday.Size = New System.Drawing.Size(11, 16)
        Me.lblToday.TabIndex = 43
        Me.lblToday.Text = "-"
        Me.lblToday.TextAlign = System.Drawing.ContentAlignment.TopCenter
        Me.lblToday.Visible = False
        '
        'login
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(8.0!, 16.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackColor = System.Drawing.Color.White
        Me.ClientSize = New System.Drawing.Size(1748, 1325)
        Me.ControlBox = False
        Me.Controls.Add(Me.Panel1)
        Me.Margin = New System.Windows.Forms.Padding(4)
        Me.MinimizeBox = False
        Me.Name = "login"
        Me.ShowIcon = False
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "login"
        Me.WindowState = System.Windows.Forms.FormWindowState.Maximized
        Me.Panel1.ResumeLayout(False)
        Me.Panel2.ResumeLayout(False)
        Me.Panel2.PerformLayout()
        Me.Panel3.ResumeLayout(False)
        CType(Me.imgFinger, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.Picture, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)

    End Sub
    Private WithEvents Picture As System.Windows.Forms.PictureBox
    Friend WithEvents Label1 As System.Windows.Forms.Label
    Friend WithEvents Label2 As System.Windows.Forms.Label
    Friend WithEvents TextBox1 As System.Windows.Forms.TextBox
    Friend WithEvents ProgressBar1 As System.Windows.Forms.ProgressBar
    Friend WithEvents Button1 As System.Windows.Forms.Button
    Friend WithEvents Label3 As Label
    Friend WithEvents Label4 As Label
    Friend WithEvents lblTime As Label
    Friend WithEvents lblDate As Label
    Friend WithEvents Timer1 As Timer
    Friend WithEvents lblToday As Label
    Friend WithEvents imgFinger As PictureBox
    Friend WithEvents Panel1 As Panel
    Friend WithEvents Timer2 As Timer
    Friend WithEvents lblLoading As Label
    Friend WithEvents Panel2 As Panel
    Friend WithEvents Panel3 As Panel
    Friend WithEvents txtToday As Label
    Friend WithEvents Panel4 As Panel
End Class
